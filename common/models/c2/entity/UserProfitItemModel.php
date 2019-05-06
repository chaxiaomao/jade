<?php

namespace common\models\c2\entity;

use common\models\c2\statics\UserKpiStateType;
use Yii;

/**
 * This is the model class for table "{{%user_profit_item}}".
 *
 * @property string $id
 * @property integer $type
 * @property string $kpi_id
 * @property string $chess_id
 * @property string $user_id
 * @property string $income
 * @property integer $state
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class UserProfitItemModel extends \cza\base\models\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_profit_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kpi_id', 'chess_id', 'user_id',], 'integer'],
            [['income'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['state', 'status', 'type'], 'integer', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app.c2', 'ID'),
            'kpi_id' => Yii::t('app.c2', 'Kpi ID'),
            'chess_id' => Yii::t('app.c2', 'Chess ID'),
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
     * @return \common\models\c2\query\UserProfitItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\c2\query\UserProfitItemQuery(get_called_class());
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

    public function getChess()
    {
        return $this->hasOne(ChessModel::className(), ['id' => 'chess_id']);
    }

    public function getUserKpi()
    {
        return $this->hasOne(UserKpiModel::className(), ['id' => 'kpi_id']);
    }

    public function isFinishCommit()
    {
        return ($this->state == UserKpiStateType::TYPE_FINISH_COMMIT);
    }

}
