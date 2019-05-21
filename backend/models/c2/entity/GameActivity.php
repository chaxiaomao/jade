<?php

namespace backend\models\c2\entity;

use Yii;
use cza\base\models\statics\EntityModelStatus;
use common\models\c2\entity\BonusActivityPrize;
use common\models\c2\entity\BonusActivityPrizeRs;
use common\models\c2\entity\EntityAttachmentImage;
use common\models\c2\entity\GameActivity as BaseModel;
use yii\helpers\ArrayHelper;

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
class GameActivity extends BaseModel {

    public $prize_items = [];  

    /**
     * @inheritdoc
     */

    public static function tableName() {
        return '{{%bonus_activity}}';
    }

    public function behaviors() {
        return ArrayHelper::merge(parent::behaviors(), [
                    'attachmentsBehavior' => [
                        'class' => \cza\base\modules\Attachments\behaviors\AttachmentBehavior::className(),
                        'config' => [
                            'entity_class' => BaseModel::className()
                        ],
                        'attributesDefinition' => [
                            'started_image' => [
                                'class' => EntityAttachmentImage::className(),
                                'validator' => 'image',
                                'rules' => [
                                    'maxFiles' => 1,
                                    'extensions' => Yii::$app->params['config']['upload']['imageWhiteExts'],
                                    'maxSize' => Yii::$app->params['config']['upload']['maxFileSize'],
                                ]
                            ],
                            'ended_image' => [
                                'class' => EntityAttachmentImage::className(),
                                'validator' => 'image',
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
    
    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['type', 'expect_num', 'join_type', 'join_time', 'is_released', 'status', 'position'], 'integer'],
            [['started_at', 'ended_at', 'prize_items','created_at', 'updated_at'], 'safe'],
            [['intro', 'started_explain', 'ended_explain'], 'string'],
            [['code', 'key_word', 'title', 'exchange_tip', 'winning_tip', 'again_tip', 'follow_url', 'share_title', 'share_desc', 'ended_title', 'other_url'], 'string', 'max' => 255],
        ];
    }


    public function loadPrizeItems() {
        $this->prize_items = $this->getPrizes()->asArray()->all();
    }

    /**
     * @inheritdoc
     */
    
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app.c2', 'ID'),
            'type' => Yii::t('app.c2', 'Type'),
            'code' => Yii::t('app.c2', 'Code'),
            'key_word' => Yii::t('app.c2', 'Key Word'),
            'title' => Yii::t('app.c2', 'Title'),
            'exchange_tip' => Yii::t('app.c2', 'Exchange Tip'),
            'winning_tip' => Yii::t('app.c2', 'Winning Tip'),
            'started_at' => Yii::t('app.c2', 'Started At'),
            'ended_at' => Yii::t('app.c2', 'Ended At'),
            'intro' => Yii::t('app.c2', 'Intro'),
            'again_tip' => Yii::t('app.c2', 'Again Tip'),
            'follow_url' => Yii::t('app.c2', 'Follow Url'),
            'other_url' => Yii::t('app.c2', 'Other Url'),
            'share_title' => Yii::t('app.c2', 'Share Title'),
            'share_desc' => Yii::t('app.c2', 'Share Desc'),
            'started_explain' => Yii::t('app.c2', 'Started Explain'),
            'ended_title' => Yii::t('app.c2', 'Ended Title'),
            'ended_explain' => Yii::t('app.c2', 'Ended Explain'),
            'expect_num' => Yii::t('app.c2', 'Expect Num'),
            'join_type' => Yii::t('app.c2', 'Join Type'),
            'join_time' => Yii::t('app.c2', 'Join Time'),
            'is_released' => Yii::t('app.c2', 'Is Released'),
            'prize_items' => Yii::t('app.c2', 'Associates {s1}', ['s1' => Yii::t('app.c2', 'Product')]),
            'status' => Yii::t('app.c2', 'Status'),
            'position' => Yii::t('app.c2', 'Position'),
            'created_at' => Yii::t('app.c2', 'Created At'),
            'updated_at' => Yii::t('app.c2', 'Updated At'),
        ];
    }

    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);
        if (!empty($this->prize_items)) {
            foreach ($this->prize_items as $item) {
                $attributes = [
                    'activity_prize_id' => isset($item['activity_prize_id']) ? $item['activity_prize_id'] : "",
                    'num' => isset($item['num']) ? $item['num'] : 0,
                    'rate' => isset($item['rate']) ? $item['rate'] : 0,
                    'status' => isset($item['status']) ? $item['status'] : 1,
                    'position' => isset($item['position']) ? $item['position'] : 50,
                ];
                if (isset($item['id']) && $item['id'] == '') {  // create new items
                    $itemModel = new \common\models\c2\entity\BonusActivityPrize();
                    $itemModel->loadDefaultValues();
                    $itemModel->setAttributes($attributes);
                    $itemModel->link('bonusActivity', $this);
//                    Yii::info('aaa');
                } else if (isset($item['id'])) {  // update itemes
                    $itemModel = BonusActivityPrize::findOne(['id' => $item['id']]);
                    if (!is_null($itemModel)) {
//                        Yii::info('sss');
                        $itemModel->updateAttributes($attributes);
                    }
                }
            }
        }
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
