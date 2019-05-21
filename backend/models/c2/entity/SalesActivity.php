<?php

namespace backend\models\c2\entity;

use Yii;
use cza\base\models\statics\EntityModelStatus;
use common\models\c2\statics\SalesActivityType;
use common\models\c2\entity\SalesActivityBudgetCoupon;
use common\models\c2\entity\EntityAttachmentImage;
use common\models\c2\entity\SalesActivity as BaseModel;

/**
 * This is the model class for table "{{%sales_activity}}".
 *
 * @property string $id
 * @property integer $type
 * @property string $code
 * @property string $title
 * @property string $content
 * @property integer $is_exclusivity
 * @property string $start_datetime
 * @property string $end_datetime
 * @property string $created_by
 * @property string $updated_by
 * @property integer $is_released
 * @property integer $status
 * @property integer $position
 * @property string $created_at
 * @property string $updated_at
 */
class SalesActivity extends BaseModel {

    public $category_ids;
    public $coupon_items = [];  // for coupon_item

    /**
     * @inheritdoc
     */

    public static function tableName() {
        return '{{%sales_activity}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['type', 'is_exclusivity', 'created_by', 'updated_by', 'is_released', 'status', 'position'], 'integer'],
            [['start_datetime', 'end_datetime', 'code', 'title'], 'required'],
            ['start_datetime', 'compare', 'compareAttribute' => 'end_datetime', 'operator' => '<='],
            [['code'], 'unique'],
            [['content'], 'string'],
            [['coupon_items', 'salespolicy_ids', 'category_ids', 'product_ids', 'region_ids'], 'safe'],
            [['start_datetime', 'end_datetime', 'created_at', 'updated_at'], 'safe'],
            [['code', 'title'], 'string', 'max' => 255],
        ];
    }

    public function behaviors() {
        return \yii\helpers\ArrayHelper::merge(parent::behaviors(), [
                    \yii\behaviors\BlameableBehavior::className(), // record created_by and updated_by
                    'CategoryBehavior' => [
                        'class' => \yii2tech\ar\linkmany\LinkManyBehavior::className(),
                        'relation' => 'productCategories', // relation, which will be handled
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
                    'SalesPolicysBehavior' => [
                        'class' => \yii2tech\ar\linkmany\LinkManyBehavior::className(),
                        'relation' => 'salesPolicys', // relation, which will be handled
                        'relationReferenceAttribute' => 'salespolicy_ids', // virtual attribute, which is used for related records specification
                        'extraColumns' => [
                            'created_at' => function() {
                                return date('Y-m-d H:i:s');
                            },
                            'updated_at' => function() {
                                return date('Y-m-d H:i:s');
                            },
                        ],
                    ],
                    'ProductBehavior' => [
                        'class' => \yii2tech\ar\linkmany\LinkManyBehavior::className(),
                        'relation' => 'products', // relation, which will be handled
                        'relationReferenceAttribute' => 'product_ids', // virtual attribute, which is used for related records specification
                        'extraColumns' => [
                            'created_at' => function() {
                                return date('Y-m-d H:i:s');
                            },
                            'updated_at' => function() {
                                return date('Y-m-d H:i:s');
                            },
                        ],
                    ],
                    'RegionBehavior' => [
                        'class' => \yii2tech\ar\linkmany\LinkManyBehavior::className(),
                        'relation' => 'regions', // relation, which will be handled
                        'relationReferenceAttribute' => 'region_ids', // virtual attribute, which is used for related records specification
                        'extraColumns' => [
                            'created_at' => function() {
                                return date('Y-m-d H:i:s');
                            },
                            'updated_at' => function() {
                                return date('Y-m-d H:i:s');
                            },
                        ],
                    ],
//                    'attachmentsBehavior' => [
//                        'class' => \cza\base\modules\Attachments\behaviors\AttachmentBehavior::className(),
//                        'config' => [
//                            'entity_class' => BaseModel::className()
//                        ],
//                        'attributesDefinition' => [
//                            'avatar' => [
//                                'class' => \common\models\c2\entity\EntityAttachmentImage::className(),
//                                'validator' => 'image',
//                                'rules' => [
//                                    'maxFiles' => 1,
//                                    'extensions' => Yii::$app->params['config']['upload']['imageWhiteExts'],
//                                    'maxSize' => Yii::$app->params['config']['upload']['maxFileSize'],
//                                ]
//                            ],
//                        ],
//                    ],
//                    'CmsContentBehavior' => [
//                        'class' => CmsContentBehavior::className(),
//                        'fields' => ['description'],
//                        'config' => [
//                            'entity_class' => BaseModel::className()
//                        ],
//                        'options' => [
//                            'renderWhenAttach' => false,
//                            'renderWhenAfterFind' => true,
//                            'renderImage' => true,
//                            'renderBlock' => false,
//                            'renderWidget' => false,
//                            'renderAlbumBlock' => false,
//                            'renderInternal' => false,
//                        ],
//                    ],
        ]);
    }

    public function loadCouponItems() {
        $this->coupon_items = $this->getCouponBudgets()->asArray()->all();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app.c2', 'ID'),
            'type' => Yii::t('app.c2', 'Type'),
            'code' => Yii::t('app.c2', 'Code'),
            'title' => Yii::t('app.c2', 'Title'),
            'content' => Yii::t('app.c2', 'Content'),
            'is_exclusivity' => Yii::t('app.c2', 'Is Exclusivity'),
            'start_datetime' => Yii::t('app.c2', 'Start Datetime'),
            'end_datetime' => Yii::t('app.c2', 'End Datetime'),
            'created_by' => Yii::t('app.c2', 'Created By'),
            'updated_by' => Yii::t('app.c2', 'Updated By'),
            'is_released' => Yii::t('app.c2', 'Is Released'),
            'status' => Yii::t('app.c2', 'Status'),
            'position' => Yii::t('app.c2', 'Position'),
            'created_at' => Yii::t('app.c2', 'Created At'),
            'updated_at' => Yii::t('app.c2', 'Updated At'),
            'category_ids' => Yii::t('app.c2', '{s1} Category', ['s1' => Yii::t('app.c2', 'Product')]),
            'salespolicy_ids' => Yii::t('app.c2', 'Associates {s1}', ['s1' => Yii::t('app.c2', 'Sales Policy')]),
            'product_ids' => Yii::t('app.c2', 'Associates {s1}', ['s1' => Yii::t('app.c2', 'Product')]),
            'region_ids' => Yii::t('app.c2', 'Associates {s1}', ['s1' => Yii::t('app.c2', 'Region')]),
            'coupon_items' => Yii::t('app.c2', 'Associates {s1}', ['s1' => Yii::t('app.c2', 'Coupon')]),
        ];
    }

    public function beforeSave($insert) {
        // convert to array and save by link behavior
        $this->save_category_ids = !empty($this->category_ids) ? explode(',', $this->category_ids) : [];
        return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);
        if (!empty($this->coupon_items)) {
            foreach ($this->coupon_items as $item) {
                $attributes = [
                    'coupon_id' => isset($item['coupon_id']) ? $item['coupon_id'] : "",
                    'retrieve_rule_id' => isset($item['retrieve_rule_id']) ? $item['retrieve_rule_id'] : "",
                    'memo' => isset($item['memo']) ? $item['memo'] : "",
                    'quota' => isset($item['quota']) ? $item['quota'] : 0,
                    'remaining_sum' => isset($item['quota']) ? $item['quota'] : 0,
                    'is_released' => isset($item['is_released']) ? $item['is_released'] : 1,
                    'position' => isset($item['position']) ? $item['position'] : 50,
                ];
                if (isset($item['id']) && $item['id'] == '') {  // create new items
                    $itemModel = new \common\models\c2\entity\SalesActivityBudgetCoupon();
                    $itemModel->loadDefaultValues();
                    $itemModel->setAttributes($attributes);
                    $itemModel->link('salesActivity', $this);
                } elseif (isset($item['id'])) {  // update itemes
                    $itemModel = SalesActivityBudgetCoupon::findOne(['id' => $item['id']]);
                    if (!is_null($itemModel)) {
                        $itemModel->updateAttributes($attributes);
                    }
                }
            }
        }
    }

    public function loadCategoryIds() {
        $this->category_ids = implode(',', $this->getProductCategories()->select('id')->column());
    }

    public function isProductPromoType() {
        return $this->type == SalesActivityType::TYPE_PRODUCT_PROMO;
    }

    public function isUserPromoType() {
        return $this->type == SalesActivityType::TYPE_USER_PROMO;
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

    public function getAttachmentImages($attribute = 'album') {
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
}
