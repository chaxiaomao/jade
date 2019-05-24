<?php

namespace backend\models\c2\entity;

use Yii;
use common\behaviors\CmsContentBehavior;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use common\models\c2\entity\CmsPage as BaseModel;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%cms_page}}".
 *
 * @property integer $id
 * @property integer $type
 * @property string $seo_code
 * @property string $title
 * @property string $breadcrumb
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $summary
 * @property string $content
 * @property string $layout
 * @property string $custom_theme
 * @property string $access_role
 * @property integer $views_count
 * @property integer $comment_count
 * @property integer $is_draft
 * @property string $released_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $status
 * @property integer $position
 * @property string $created_at
 * @property string $updated_at
 * @property integer $is_homepage
 */
class CmsPage extends BaseModel {

    public function behaviors() {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => function () {
                    return date('Y-m-d H:i:s');
                },
            ],
            'contentBehavior' => [
                'class' => CmsContentBehavior::className(),
                'fields' => ['content'],
                'config' => [
                    'entity_class' => BaseModel::className()
                ],
                'options' => [
                    'renderWhenAttach' => false,
                    'renderWhenAfterFind' => false,
                    'renderImage' => true,
                    'renderBlock' => false,
                    'renderWidget' => false,
                    'renderAlbumBlock' => false,
                    'renderInternal' => false,
                ],
            ],
        ];
    }

    /**
     * setup default values
     * */
    public function loadDefaultValues($skipIfSet = true) {
        $this->layout = 'cms_homepage_v3';
        parent::loadDefaultValues($skipIfSet);
    }

}
