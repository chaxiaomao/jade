<?php

namespace backend\models\c2\entity;

use Yii;
use common\behaviors\CmsContentBehavior;
use common\models\c2\entity\EntityAttachment;
use common\models\c2\entity\EntityAttachmentImage;
use common\models\c2\entity\EntityAttachmentFile;
use cza\base\models\statics\EntityModelStatus;
use common\models\c2\entity\ProductSku as BaseModel;
use common\models\c2\statics\CheckoutPoint;

class ProductSku extends BaseModel {
    public function behaviors() {
        return \yii\helpers\ArrayHelper::merge(parent::behaviors(), [
                    \yii\behaviors\BlameableBehavior::className(), 
                    'attachmentsBehavior' => [
                        'class' => \cza\base\modules\Attachments\behaviors\AttachmentBehavior::className(),
                        'config' => [
                            'entity_class' => BaseModel::className()
                        ],
                        'attributesDefinition' => [
                            'addto_cart_sku' => [
                                'class' => \common\models\c2\entity\EntityAttachmentImage::className(),
                                'validator' => 'image',
                                'enableVersions' => true, // determine to generate difference size images
                                'rules' => [
                                    'maxFiles' => 1,
                                    'extensions' => Yii::$app->params['config']['upload']['imageWhiteExts'],
                                    'maxSize' => Yii::$app->params['config']['upload']['maxFileSize'],
                                ]
                            ],
                            'logo' => [
                                'class' => \common\models\c2\entity\EntityAttachmentImage::className(),
                                'validator' => 'image',
                                'enableVersions' => true, // determine to generate difference size images
                                'rules' => [
                                    'maxFiles' => 1,
                                    'extensions' => Yii::$app->params['config']['upload']['imageWhiteExts'],
                                    'maxSize' => Yii::$app->params['config']['upload']['maxFileSize'],
                                ]
                            ],
                        ],
                    ],
        ]);
    }
    
    public function getAttachmentImage($attribute) {
        return $this->getAttachmentImages($attribute)->one();
    }

    public function getAllAttachments() {
        $condition = ['entity_class' => BaseModel::className()];
        return $this->hasMany(EntityAttachment::className(), ['entity_id' => 'id'])
                        ->andOnCondition($condition)
                        ->orderBy(['position' => SORT_DESC, 'id' => SORT_ASC]);
    }

    public function getAttachmentImages($attribute = 'addto_cart_sku') {
        $condition = !empty($attribute) ? ['entity_class' => BaseModel::className(), 'entity_attribute' => $attribute, 'status' => EntityModelStatus::STATUS_ACTIVE] : ['entity_class' => BaseModel::className(), 'status' => EntityModelStatus::STATUS_ACTIVE];
        return $this->hasMany(EntityAttachmentImage::className(), ['entity_id' => 'id'])
                        ->andOnCondition($condition)
                        ->orderBy(['position' => SORT_DESC, 'id' => SORT_ASC]);
    }

    public function getAttachmentFiles($attribute = 'files') {
        return $this->hasMany(EntityAttachmentFile::className(), ['entity_id' => 'id'])
                        ->andOnCondition(['entity_class' => BaseModel::className(), 'entity_attribute' => $attribute, 'status' => EntityModelStatus::STATUS_ACTIVE])
                        ->orderBy(['position' => SORT_DESC, 'id' => SORT_ASC]);
    }

    public function getInstallPrice($checkoutPoint = CheckoutPoint::TYPE_SHOW) {
        return $this->install_price;
    }

}
