<?php

namespace backend\models\c2\entity;

use common\models\c2\entity\Topic;
use common\models\c2\entity\EntityAttachmentFile;
use common\models\c2\entity\EntityAttachmentImage;
use common\models\c2\entity\TopicArticleWechat;
use common\models\c2\statics\TopicArticleType;
use cza\base\models\statics\EntityModelStatus;
use Yii;
use common\behaviors\CmsContentBehavior;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use common\models\c2\entity\TopicArticle as BaseModel;

/**
 * This is the model class for table "{{%topic_article}}".
 *
 * @property string $id
 * @property integer $type
 * @property string $title
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $summary
 * @property string $content
 * @property integer $author_id
 * @property string $author_name
 * @property integer $views_count
 * @property integer $comment_count
 * @property string $released_at
 * @property integer $is_shared
 * @property string $created_by
 * @property string $updated_by
 * @property integer $status
 * @property integer $position
 * @property string $created_at
 * @property string $updated_at
 */
class TopicArticle extends BaseModel {

    public function behaviors() {
        return [
            \yii\behaviors\BlameableBehavior::className(), // record created_by and updated_by
            'contentBehavior' => [
                'class' => CmsContentBehavior::className(),
                'fields' => ['content'],
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
            'attachmentsBehavior' => [
                'class' => \cza\base\modules\Attachments\behaviors\AttachmentBehavior::className(),
                'config' => [
                    'entity_class' => BaseModel::className()
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
            'topicsBehavior' => [
                'class' => \yii2tech\ar\linkmany\LinkManyBehavior::className(),
                'relation' => 'topics', // relation, which will be handled
                'relationReferenceAttribute' => 'topic_ids', // virtual attribute, which is used for related records specification
                'extraColumns' => [
                    'created_at' => function() {
                        return date('Y-m-d H:i:s');
                    },
                    'updated_at' => function() {
                        return date('Y-m-d H:i:s');
                    },
                ],
            ],
        ];
    }

    public function getTopics() {
        return $this->hasMany(Topic::className(), ['id' => 'topic_id'])
                        ->where(['status' => EntityModelStatus::STATUS_ACTIVE])
                        ->viaTable('{{%topic_article_rs}}', ['article_id' => 'id']);
    }

    public function getAttachmentImage($attribute) {
        return $this->getAttachmentImages($attribute)->one();
    }

//    public function getAllAttachments() {
//        $condition = ['entity_class' => BaseModel::className()];
//        return $this->hasMany(EntityAttachmentImage::className(), ['entity_id' => 'id'])
//            ->andOnCondition($condition)
//            ->orderBy(['position' => SORT_DESC, 'id' => SORT_ASC]);
//    }
//
//    public function getAttachmentImages($attribute = 'album') {
//        $condition = !empty($attribute) ? ['entity_class' => BaseModel::className(), 'entity_attribute' => $attribute, 'status' => EntityModelStatus::STATUS_ACTIVE] : ['entity_class' => BaseModel::className(), 'status' => EntityModelStatus::STATUS_ACTIVE];
//        return $this->hasMany(EntityAttachmentImage::className(), ['entity_id' => 'id'])
//            ->andOnCondition($condition)
//            ->orderBy(['position' => SORT_DESC, 'id' => SORT_ASC]);
//    }
//
//    public function getAttachmentFiles($attribute = 'files') {
//        return $this->hasMany(EntityAttachmentFile::className(), ['entity_id' => 'id'])
//            ->andOnCondition(['entity_class' => BaseModel::className(), 'entity_attribute' => $attribute, 'status' => EntityModelStatus::STATUS_ACTIVE])
//            ->orderBy(['position' => SORT_DESC, 'id' => SORT_ASC]);
//    }
}
