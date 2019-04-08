<?php

namespace common\models\c2\entity;

use Yii;

/**
 * This is the model class for table "{{%fe_user_auth}}".
 *
 * @property string $id
 * @property integer $type
 * @property string $user_id
 * @property string $source
 * @property string $source_id
 * @property string $expired_at
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class FeUserAuthModel extends \cza\base\models\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%fe_user_auth}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'type'], 'integer'],
            [['expired_at', 'created_at', 'updated_at'], 'safe'],
            [['status'], 'integer', 'max' => 4],
            [['source', 'source_id'], 'string', 'max' => 255],
            [['source'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app.c2', 'ID'),
            'type' => Yii::t('app.c2', 'Type'),
            'user_id' => Yii::t('app.c2', 'User ID'),
            'source' => Yii::t('app.c2', 'Source'),
            'source_id' => Yii::t('app.c2', 'Source ID'),
            'expired_at' => Yii::t('app.c2', 'Expired At'),
            'status' => Yii::t('app.c2', 'Status'),
            'created_at' => Yii::t('app.c2', 'Created At'),
            'updated_at' => Yii::t('app.c2', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\c2\query\FeUserAuthQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\c2\query\FeUserAuthQuery(get_called_class());
    }
    
    /**
    * setup default values
    **/
    public function loadDefaultValues($skipIfSet = true) {
        parent::loadDefaultValues($skipIfSet);
    }

}
