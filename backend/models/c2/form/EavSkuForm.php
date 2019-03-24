<?php

namespace backend\models\c2\form;

use Yii;
use yii\base\Model;
use cza\base\models\ModelTrait;
use common\models\c2\statics\AttributeInputType;
use yii\validators\Validator;
use common\models\c2\entity\AttributeItem;
use common\models\c2\entity\ProductSku;
use yii\helpers\Json;

/**
 * EavSkuForm is the model behind the contact form.
 */
class EavSkuForm extends Model {

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
        $this->entityModel->refresh();
        $this->_values = $this->entityModel->getEavValues();
//        Yii::info($this->_values);

        $eavAttrs = $this->getEntityEavAttributes();
        foreach ($eavAttrs as $eavCode => $eavAttr) {
            if ($eavAttr->is_required) {
                $this->addRule([$eavCode], 'required');
            }
            if ($eavAttr->is_unique) {
                $this->addRule([$eavCode], 'unique', ['targetClass' => $this->entityModel->getVModelClass(), 'targetAttribute' => 'value']);
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

    public function descartes($arr) {
        $t = func_get_args();                                    // 获取传入的参数
        if (func_num_args() == 1) {                               // 判断参数个数是否为1
            if (is_array($t[0])) {
                return call_user_func_array([$this, __FUNCTION__], $t[0]);  // 回调当前函数，并把第一个数组作为参数传入
            }
        }

        $a = array_shift($t);        // 将 $t 中的第一个元素移动到 $a 中，$t 中索引值重新排序
        if (!is_array($a)) {
            $a = array($a);
        }

        $a = array_chunk($a, 1);     // 分割数组 $a ，为每个单元1个元素的新数组
        do {
            $r = array();
            $b = array_shift($t);
            if (!is_array($b)) {
                $b = array($b);
            }
            foreach ($a as $p) {
                foreach (array_chunk($b, 1) as $q) {
                    $r[] = array_merge($p, $q);
                }
            }
            $a = $r;
        } while ($t);

        return $r;
    }

    public function generateSkus($params, $labelSpliter = '/') {

        // update eav fields
        $this->entityModel->updateEavAttributes($params);

        $skus = $params;
        $skuParams = $params;
        $skuLabels = $params;
        $attrsCount = 0;
        foreach ($params as $k1 => $values) {
            $metaEavAttribute = $this->getEntityEavAttribute($k1);
            if (is_string($values) && !empty($values)) {
                $id = $values;
//                $skus[$k1] = "{$this->entityModel->id}:{$k1}:{$id}";
                $skus[$k1] = "{$id}";
                $skuParams[$k1] = "{$k1}:{$id}";
                $skuLabels[$k1] = $metaEavAttribute->getTitle() . ':' . AttributeItem::findOne(['id' => $id])->label;
            } elseif (is_array($values)) {
                foreach ($values as $k2 => $value) {
//                    $skus[$k1][$k2] = "{$this->entityModel->id}:{$k1}:{$value}";
                    $skus[$k1][$k2] = "{$value}";
                    $skuParams[$k1][$k2] = "{$k1}:{$value}";
                    $skuLabels[$k1][$k2] = $metaEavAttribute->getTitle() . ':' . AttributeItem::findOne(['id' => $value])->label;
                }
            }
            $attrsCount++;
        }

//        Yii::info(array_keys($params));
//        Yii::info("attrsCount: " . $attrsCount);
//        Yii::info($skus);
//        Yii::info($skuParams);
//
        $skus = $this->descartes($skus);
        $skuLabels = $this->descartes($skuLabels);
        $skuParams = $this->descartes($skuParams);

        $hashEncoder = Yii::$app->czaHelper->password;

        if ($attrsCount == 1) {
            $i = 0;
            if (is_array($skus[$i])) {
                foreach ($skus[$i] as $key => $item) {
                    $hashContent = $this->entityModel->id . $item;
                    $hash = $hashEncoder->hexEncode($hashContent);
//                    Yii::info($key . ':' . $item . ':' . $hash);
                    ProductSku::createSku([
                        'product_id' => $this->entityModel->id,
                        'sku' => $this->entityModel->sku . "-" . $hash,
                        'hash' => $hash,
                        'attr_params' => $skuParams[$i][$key],
                        'name' => $skuLabels[$i][$key],
                        'label' => $skuLabels[$i][$key],
                    ]);
                }
            }
        } else {
            $count = count($skus);
            for ($i = 0; $i < $count; $i++) {
                if ($count > 0) {
                    $skus[$i] = array_filter($skus[$i], function($value) { return $value !== ''; });
                    $skuParams[$i] = array_filter($skuParams[$i], function($value) { return $value !== ''; });
                    $hashContent = $this->entityModel->id . implode(',', $skus[$i]);
                    $hash = $hashEncoder->hexEncode($hashContent);
                    ProductSku::createSku([
                        'product_id' => $this->entityModel->id,
                        'sku' => $this->entityModel->sku . "-" . $hash,
                        'hash' => $hash,
                        'attr_params' => implode($labelSpliter, $skuParams[$i]),
                        'name' => implode($labelSpliter, $skuLabels[$i]),
                        'label' => implode($labelSpliter, $skuLabels[$i]),
                    ]);
                }
            }
        }


        return true;
    }

    public function getEntityEavAttribute($code) {
        $attrs = $this->getEntityEavAttributes();
        return isset($attrs[$code]) ? $attrs[$code] : null;
    }

    public function getEntityEavAttributes() {
        if (empty($this->_eavAttributes)) {
            $metaAttributes = $this->entityModel->getMetaEavAttributes()->all();

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
            if ($attribute->is_sku) {
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

//    public function save() {
//        if (!($this->validate())) {
//            return false;
//        }
//
////        Yii::info($this->_values);
//        $transaction = Yii::$app->db->beginTransaction();
//        $this->entityModel->updateEavAttributes($this->_values);
//        $transaction->commit();
//
//        // reload attributes
//        $this->entityModel->loadEavAttributes(true);
//        return true;
//    }

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
