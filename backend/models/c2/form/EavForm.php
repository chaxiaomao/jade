<?php

namespace backend\models\c2\form;

use Yii;
use yii\base\Model;
use cza\base\models\ModelTrait;
use common\models\c2\statics\AttributeInputType;
use yii\validators\Validator;

/**
 * EavForm is the model behind the contact form.
 */
class EavForm extends Model {

    use ModelTrait;

    private $_attributes = [];
    private $_values = [];
    protected $_eavAttributes = [];
    protected $_eavAttributesLabels = [];
    protected $_extraParams = [];  // store extra params
    public $entityModel = null;
    public $message;

    public function init() {
        parent::init();
        if (is_null($this->entityModel)) {
            throw new \yii\web\NotFoundHttpException("EntityModel is required!");
        }
        $this->_values = $this->entityModel->getEavValues();
//        Yii::info($this->_values);

        $eavAttrs = $this->getEntityEavAttributes();
        foreach ($eavAttrs as $eavCode => $eavAttr) {
            if ($eavAttr->is_required) {
                $this->addRule([$eavCode], 'required');
            }
            if ($eavAttr->is_unique) {
                $this->addRule([$eavCode], \backend\components\validators\EavUniqueValidator::className(), ['entityValModel'=>$this->entityModel->getVModel($eavCode) , 'targetClass' => $this->entityModel->getVModelClass(), 'targetAttribute' => 'value']);
            }

            if (!$eavAttr->is_required && !$eavAttr->is_unique) {
                $this->addRule([$eavCode], 'safe');
            }
        }
    }

    public function addRule($attributes, $validator, $options = []) {
        $validators = $this->getValidators();
        $validators->append(Validator::createValidator($validator, $this, (array) $attributes, $options));
        return $this;
    }

    public function getEntityEavAttributeDefault($name) {
        $attr = $this->getEntityEavAttribute($name);
        if (!is_null($attr)) {
            return $attr->getEavDefaultValue();
        }
        return null;
    }

    public function getEntityEavAttribute($code) {
        $attrs = $this->getEntityEavAttributes();
        return isset($attrs[$code]) ? $attrs[$code] : null;
    }

    public function getEntityEavAttributes() {
        if (empty($this->_eavAttributes)) {
            $metaAttributes = $this->entityModel->getNonSkuMetaEavAttributes()->all();
//            $metaAttributes = $this->entityModel->getMetaEavAttributes()->all();
            foreach ($metaAttributes as $metaAttribute) {
                $this->_eavAttributes[$metaAttribute->code] = $metaAttribute;
            }
        }
        return $this->_eavAttributes;
    }

    public function getEavFormAttributes() {
        $eavAttrs = [];
        $attributes = $this->getEntityEavAttributes();
        $regularLangName = \Yii::$app->czaHelper->getRegularLangName();
        foreach ($attributes as $attribute) {
            switch ($attribute->input_type) {
                case AttributeInputType::INPUT_DROPDOWN_LIST:
                case AttributeInputType::INPUT_CHECKBOX_LIST:
                case AttributeInputType::INPUT_RADIO_LIST:
                    $eavAttrs[$attribute->code] = ['type' => $attribute->input_type, 'hint' => $attribute->hint, 'items' => $attribute->getItemsHashMap('id', 'label')];
                    break;
                case AttributeInputType::INPUT_RICHTEXT:
                    $eavAttrs[$attribute->code] = ['type' => AttributeInputType::INPUT_WIDGET, 'widgetClass' => '\vova07\imperavi\Widget', 'options' => [
                            'settings' => [
                                'minHeight' => 150,
                                'buttonSource' => true,
                                'lang' => $regularLangName,
                                'plugins' => [
                                    'fontsize',
                                    'fontfamily',
                                    'fontcolor',
                                    'table',
                                    'textdirection',
                                    'fullscreen',
                                ],
                            ]
                        ],];
                    break;
                case AttributeInputType::INPUT_TEXT:
                case AttributeInputType::INPUT_TEXTAREA:
                default:
                    $eavAttrs[$attribute->code] = ['type' => $attribute->input_type, 'hint' => $attribute->hint, 'options' => ['placeholder' => $this->getAttributeLabel($attribute->code)]];
                    break;
            }
        }
        return $eavAttrs;
    }

    public function setExtraParams($v) {
        $this->_extraParams = $v;
    }

    public function getExtraParams($k = null) {
        if (is_null($k)) {
            return $this->_extraParams;
        }
        return $this->_extraParams[$k];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        if (empty($this->_eavAttributesLabels)) {
            $attributes = $this->getEntityEavAttributes();
            $labels = [];
            foreach ($attributes as $attribute) {
                $labels[$attribute->code] = $attribute->label;
            }
            $this->_eavAttributesLabels = $labels;
        }
        return $this->_eavAttributesLabels;
    }

    public function beforeValidate() {

        return parent::beforeValidate();
    }

    public function afterValidate() {
        parent::afterValidate();
    }

    public function save() {
        if (!($this->validate())) {
            return false;
        }

//        Yii::info($this->_values);
        $transaction = Yii::$app->db->beginTransaction();
        $this->entityModel->updateEavAttributes($this->_values);
        $transaction->commit();

        // reload attributes
        $this->entityModel->loadEavAttributes(true);
        return true;
    }

    public function canGetProperty($name, $checkVars = true, $checkBehaviors = true) {
        if (!parent::canGetProperty($name, $checkVars, $checkBehaviors)) {
            return in_array($name, $this->_attributes);
        }
        return true;
    }

    public function canSetProperty($name, $checkVars = true, $checkBehaviors = true) {
        if (!parent::canSetProperty($name, $checkVars, $checkBehaviors)) {
            return in_array($name, $this->_attributes);
        }
        return true;
    }

    public function __get($name) {
        if (array_key_exists($name, $this->_values)) {
            if (!empty($this->_values[$name])) {
                return $this->_values[$name];
            } else {
                return $this->getEntityEavAttributeDefault($name);
            }
        }
        return parent::__get($name);
    }

    public function __set($name, $value) {
        if (array_key_exists($name, $this->_values)) {
            $this->_values[$name] = $value;
        } else {
            parent::__set($name, $value);
        }
    }

    public function errorSummary($form) {
        $errorLists = [];
        foreach ($this->getAllModels() as $id => $model) {
            $errorList = $form->errorSummary($model, [
                'header' => '<p>Please fix the following errors for <b>' . $id . '</b></p>',
            ]);
            $errorList = str_replace('<li></li>', '', $errorList); // remove the empty error
            $errorLists[] = $errorList;
        }
        return implode('', $errorLists);
    }

    protected function getAllModels() {
        return [
        ];
    }

}
