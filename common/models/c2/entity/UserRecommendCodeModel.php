<?php

namespace common\models\c2\entity;

use Yii;

/**
 * This is the model class for table "{{%user_recommend_code}}".
 *
 * @property string $id
 * @property integer $type
 * @property string $user_id
 * @property string $code
 * @property string $chess_id
 * @property string $expired_at
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class UserRecommendCodeModel extends \cza\base\models\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_recommend_code}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'user_id', 'chess_id'], 'integer'],
            [['expired_at', 'created_at', 'updated_at'], 'safe'],
            [['code'], 'string', 'max' => 255],
            [['status'], 'integer', 'max' => 4],
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
            'code' => Yii::t('app.c2', 'Code'),
            'chess_id' => Yii::t('app.c2', 'Chess ID'),
            'expired_at' => Yii::t('app.c2', 'Expired At'),
            'status' => Yii::t('app.c2', 'Status'),
            'created_at' => Yii::t('app.c2', 'Created At'),
            'updated_at' => Yii::t('app.c2', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\c2\query\UserRecommendCodeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\c2\query\UserRecommendCodeQuery(get_called_class());
    }
    
    /**
    * setup default values
    **/
    public function loadDefaultValues($skipIfSet = true) {
        parent::loadDefaultValues($skipIfSet);
    }

}
