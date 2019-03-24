<?php

namespace backend\models\c2\entity;

use Yii;
use common\behaviors\CmsContentBehavior;
use common\models\c2\entity\EntityAttachment;
use common\models\c2\entity\EntityAttachmentImage;
use common\models\c2\entity\EntityAttachmentFile;
use cza\base\models\statics\EntityModelStatus;
use common\models\c2\entity\GroupProduct as BaseModel;
use common\models\c2\statics\CheckoutPoint;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property string $id
 * @property string $eshop_id
 * @property integer $type
 * @property string $seo_code
 * @property string $sku
 * @property string $serial_number
 * @property string $breadcrumb
 * @property string $Product
 * @property string $label
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $sales_price
 * @property string $cost_price
 * @property string $market_price
 * @property string $supplier_id
 * @property string $currency_id
 * @property string $measure_id
 * @property string $summary
 * @property string $description
 * @property integer $views_count
 * @property integer $comment_count
 * @property integer $require_setup
 * @property integer $is_released
 * @property string $released_at
 * @property string $created_by
 * @property string $updated_by
 * @property integer $status
 * @property integer $position
 * @property string $created_at
 * @property string $updated_at
 */
class GroupProduct extends BaseModel {
    

    public function behaviors() {
        return \yii\helpers\ArrayHelper::merge(parent::behaviors(), [
                    \yii\behaviors\BlameableBehavior::className(), // record created_by and updated_by
                    'categoryBehavior' => [
                        'class' => \yii2tech\ar\linkmany\LinkManyBehavior::className(),
                        'relation' => 'categories', // relation, which will be handled
                        'relationReferenceAttribute' => 'save_category_ids', // virtual attribute, which is used for related records specification
                        'extraColumns' => [
                            'created_at' => function() {
                                return date('Y-m-d H:i:s');
                            },
                            'updated_at' => function() {
                                return date('Y-m-d H:i:s');
                            },
                        ],
                    ],
//                    'attributesetBehavior' => [
//                        'class' => \yii2tech\ar\linkmany\LinkManyBehavior::className(),
//                        'relation' => 'attributesets', // relation, which will be handled
//                        'relationReferenceAttribute' => 'attributeset_ids', // virtual attribute, which is used for related records specification
//                        'extraColumns' => [
//                            'created_at' => function() {
//                                return date('Y-m-d H:i:s');
//                            },
//                            'updated_at' => function() {
//                                return date('Y-m-d H:i:s');
//                            },
//                        ],
//                    ],
                    'associatedProductsBehavior' => [
                        'class' => \yii2tech\ar\linkmany\LinkManyBehavior::className(),
                        'relation' => 'associatedProducts',
                        'relationReferenceAttribute' => 'child_ids',
                        'extraColumns' => [
                            'created_at' => function() {
                                return date('Y-m-d H:i:s');
                            },
                            'updated_at' => function() {
                                return date('Y-m-d H:i:s');
                            },
                        ],
                    ],
                    'metaEavAttributesBehavior' => [
                        'class' => \yii2tech\ar\linkmany\LinkManyBehavior::className(),
                        'relation' => 'metaEavAttributes', // relation, which will be handled
                        'relationReferenceAttribute' => 'meta_attributes_ids', // virtual attribute, which is used for related records specification
                        'extraColumns' => [
                            'created_at' => function() {
                                return date('Y-m-d H:i:s');
                            },
                            'updated_at' => function() {
                                return date('Y-m-d H:i:s');
                            },
                        ],
                    ],
//                    'eavBehavior' => [
//                        'class' => \common\behaviors\EavBehavior::className(),
//                        'vModelClass' => \common\models\c2\entity\ProductEav::className(),
//                        'aModelClass' => \common\models\c2\entity\Attribute::className(),
//                    ],
                    'attachmentsBehavior' => [
                        'class' => \cza\base\modules\Attachments\behaviors\AttachmentBehavior::className(),
                        'config' => [
                            'entity_class' => \common\models\c2\entity\Product::className()
                        ],
                        'attributesDefinition' => [
                            'avatar' => [
                                'class' => \common\models\c2\entity\EntityAttachmentImage::className(),
                                'validator' => 'image',
                                'rules' => [
                                    'maxFiles' => 1,
                                    'extensions' => Yii::$app->params['config']['upload']['imageWhiteExts'],
                                    'maxSize' => Yii::$app->params['config']['upload']['maxFileSize'],
                                ]
                            ],
                        ],
                    ],
                    'CmsContentBehavior' => [
                        'class' => CmsContentBehavior::className(),
                        'fields' => ['description'],
                        'config' => [
                            'entity_class' => BaseModel::className()
                        ],
                        'options' => [
                            'renderWhenAttach' => false,
                            'renderWhenAfterFind' => true,
                            'renderImage' => true,
                            'renderBlock' => false,
                            'renderWidget' => false,
                            'renderAlbumBlock' => false,
                            'renderInternal' => false,
                        ],
                    ],
                    'productvrBehavior' => [
                        'class' => \yii2tech\ar\linkmany\LinkManyBehavior::className(),
                        'relation' => 'productVr',
                        'relationReferenceAttribute' => 'productvr_ids',
                        'extraColumns' => [
                            'created_at' => function() {
                                return date('Y-m-d H:i:s');
                            },
                            'updated_at' => function() {
                                return date('Y-m-d H:i:s');
                            },
                        ],
                    ],
        ]);
    }

    public function getAttachmentImage($attribute) {
        return $this->getAttachmentImages($attribute)->one();
    }

    public function getAllAttachments() {
        $condition = ['entity_class' => \common\models\c2\entity\Product::className()];
        return $this->hasMany(EntityAttachment::className(), ['entity_id' => 'id'])
                        ->andOnCondition($condition)
                        ->orderBy(['position' => SORT_DESC, 'id' => SORT_ASC]);
    }

    public function getAttachmentImages($attribute = 'album') {
        $condition = !empty($attribute) ? ['entity_class' => \common\models\c2\entity\Product::className(), 'entity_attribute' => $attribute, 'status' => EntityModelStatus::STATUS_ACTIVE] : ['entity_class' => \common\models\c2\entity\Product::className(), 'status' => EntityModelStatus::STATUS_ACTIVE];
        return $this->hasMany(EntityAttachmentImage::className(), ['entity_id' => 'id'])
                        ->andOnCondition($condition)
                        ->orderBy(['position' => SORT_DESC, 'id' => SORT_ASC]);
    }

    public function getAttachmentFiles($attribute = 'files') {
        return $this->hasMany(EntityAttachmentFile::className(), ['entity_id' => 'id'])
                        ->andOnCondition(['entity_class' => \common\models\c2\entity\Product::className(), 'entity_attribute' => $attribute, 'status' => EntityModelStatus::STATUS_ACTIVE])
                        ->orderBy(['position' => SORT_DESC, 'id' => SORT_ASC]);
    }

    public function getInstallPrice($checkoutPoint = CheckoutPoint::TYPE_SHOW) {
         return $this->install_price;
    }

}
