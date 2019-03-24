<?php

namespace backend\models\c2\form;

use Yii;
use yii\base\Model;
use cza\base\models\ModelTrait;
use common\models\c2\entity\TemplateInfoWechat;
use common\models\c2\entity\WechatInfoQueue;
use common\models\c2\entity\FeUser;

/**
 * TplInfoWechatForm is used to collect wechat template info
 */
class TplInfoWechatForm extends Model {

    use ModelTrait;

    protected $_infoModel = null;
    protected $_queueModel;
    public $content;
    public $url;
    public $to_user_ids;

    public function init() {
        parent::init();
        if (is_null($this->_infoModel)) {
            throw new \yii\base\ErrorException("Info Model is required!");
        }
        $this->loadDefaultValues();
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            // name, email, subject and body are required
            [['content', 'to_user_ids',], 'required'],
            [['content', 'url'], 'string',],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'url' => Yii::t('app.c2', 'Url'),
            'content' => Yii::t('app.c2', 'Content'),
            'to_user_ids' => Yii::t('app.c2', 'Recipients'),
        ];
    }

    public function send() {
        if (!($this->validate())) {
            return FALSE;
        }

        $tplModel = $this->getInfoModel();
        $toUsers = FeUser::findAll(['id' => $this->to_user_ids]);
        $datum = [
            'url' => $this->url,
            'data' => $this->content,
        ];

        if (!$tplModel->send($datum, $toUsers)) {
            $this->addError('to_user_ids', Yii::t('app.c2', "There is an error triggered when process, Please contact technical support!"));
        }

        return !$this->hasErrors();
    }

    public function loadDefaultValues() {
        if (empty($this->content)) {
            $this->content = $this->infoModel->content;
        }
    }

    public function getNavigationTitle() {
        $model = $this->getInfoModel();
        return "{$model->primary_industry} > {$model->deputy_industry} > {$model->title}";
    }

    public function getQueueModel() {
        if ($this->_queueModel === null) {
            $this->_queueModel = new WechatInfoQueue();
            $this->_queueModel->loadDefaultValues();
        }
        return $this->_queueModel;
    }

    public function setQueueModel($model) {
        $this->_queueModel = $model;
    }

    public function getInfoModel() {
        return $this->_infoModel;
    }

    public function setInfoModel($model) {
        $this->_infoModel = $model;
    }

    public function errorSummary($form) {
        $errorLists = [];
        foreach ($this->getAllModels() as $model) {
            $errorList = $form->errorSummary($model, [
                'header' => '<p>Please fix the following errors for <b>' . $model->className() . '</b></p>',
            ]);
            $errorList = str_replace('<li></li>', '', $errorList); // remove the empty error
            $errorLists[] = $errorList;
        }
        return implode('', $errorLists);
    }

    private function getAllModels() {
        return [
            $this->getInfoModel(), $this->getQueueModel(),
        ];
    }

}
