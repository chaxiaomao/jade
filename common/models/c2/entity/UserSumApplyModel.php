<?php

namespace common\models\c2\entity;

use Yii;

/**
 * This is the model class for table "{{%user_sum_apply}}".
 *
 * @property string $id
 * @property integer $type
 * @property string $user_id
 * @property string $apply_sum
 * @property string $bank_name
 * @property string $hash
 * @property string $confirmed_at
 * @property string $name
 * @property string $mobile_number
 * @property string $bank_card_number
 * @property string $transfer_rate
 * @property string $received_sum
 * @property string $memo
 * @property integer $state
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class UserSumApplyModel extends \cza\base\models\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_sum_apply}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['apply_sum', 'transfer_rate', 'received_sum'], 'number'],
            [['confirmed_at', 'created_at', 'updated_at'], 'safe'],
            [['type', 'state', 'status'], 'integer', 'max' => 4],
            [['memo'], 'string',],
            [['bank_name', 'hash', 'name', 'mobile_number', 'bank_card_number'], 'string', 'max' => 255],
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
            'apply_sum' => Yii::t('app.c2', 'Apply Sum'),
            'bank_name' => Yii::t('app.c2', 'Bank Name'),
            'hash' => Yii::t('app.c2', 'Hash'),
            'confirmed_at' => Yii::t('app.c2', 'Confirmed At'),
            'name' => Yii::t('app.c2', 'Name'),
            'mobile_number' => Yii::t('app.c2', 'Mobile Number'),
            'bank_card_number' => Yii::t('app.c2', 'Bank Card Number'),
            'transfer_rate' => Yii::t('app.c2', 'Transfer Rate'),
            'received_sum' => Yii::t('app.c2', 'Received Sum'),
            'memo' => Yii::t('app.c2', 'Memo'),
            'state' => Yii::t('app.c2', 'State'),
            'status' => Yii::t('app.c2', 'Status'),
            'created_at' => Yii::t('app.c2', 'Created At'),
            'updated_at' => Yii::t('app.c2', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\c2\query\UserSumApplyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\c2\query\UserSumApplyQuery(get_called_class());
    }
    
    /**
    * setup default values
    **/
    public function loadDefaultValues($skipIfSet = true) {
        parent::loadDefaultValues($skipIfSet);
    }

    public function getUser()
    {
        return $this->hasOne(FeUserModel::className(), ['id' => 'user_id']);
    }

    public function setStateFinish()
    {
        $user = $this->user;
        $user->profit->updateCounter(['imcome' => -($this->apply_sum)]);
    }

}
