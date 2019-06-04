<?php

namespace common\models\c2\entity;

use Yii;

/**
 * This is the model class for table "{{%user_profit}}".
 *
 * @property integer $id
 * @property integer $type
 * @property integer $user_id
 * @property string $income
 * @property integer $state
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class UserProfitModel extends \cza\base\models\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_profit}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'user_id'], 'integer'],
            [['income'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['state', 'status'], 'integer', 'max' => 4],
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
            'income' => Yii::t('app.c2', 'Income'),
            'state' => Yii::t('app.c2', 'State'),
            'status' => Yii::t('app.c2', 'Status'),
            'created_at' => Yii::t('app.c2', 'Created At'),
            'updated_at' => Yii::t('app.c2', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\c2\query\UserProfitQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\c2\query\UserProfitQuery(get_called_class());
    }
    
    /**
    * setup default values
    **/
    public function loadDefaultValues($skipIfSet = true) {
        parent::loadDefaultValues($skipIfSet);
    }

}
