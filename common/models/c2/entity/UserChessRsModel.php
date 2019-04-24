<?php

namespace common\models\c2\entity;

use Yii;

/**
 * This is the model class for table "{{%user_chess_rs}}".
 *
 * @property string $id
 * @property string $user_id
 * @property string $chess_id
 * @property integer $type
 * @property integer $state
 * @property integer $status
 * @property integer $position
 * @property string $created_at
 * @property string $updated_at
 */
class UserChessRsModel extends \cza\base\models\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_chess_rs}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'chess_id', 'position'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['type', 'status', 'state'], 'integer', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app.c2', 'ID'),
            'user_id' => Yii::t('app.c2', 'User ID'),
            'chess_id' => Yii::t('app.c2', 'Chess ID'),
            'type' => Yii::t('app.c2', 'Type'),
            'status' => Yii::t('app.c2', 'Status'),
            'position' => Yii::t('app.c2', 'Position'),
            'created_at' => Yii::t('app.c2', 'Created At'),
            'updated_at' => Yii::t('app.c2', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\c2\query\UserChessRsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\c2\query\UserChessRsQuery(get_called_class());
    }
    
    /**
    * setup default values
    **/
    public function loadDefaultValues($skipIfSet = true) {
        parent::loadDefaultValues($skipIfSet);
    }

}
