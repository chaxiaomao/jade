<?php

namespace common\models\c2\entity;

use backend\models\c2\entity\rbac\BeUser;
use common\models\c2\statics\UserKpiStateType;
use common\models\c2\statics\UserProfitState;
use Yii;

/**
 * This is the model class for table "{{%user_kpi}}".
 *
 * @property integer $id
 * @property integer $grp_id
 * @property integer $join_user_id
 * @property integer $invite_user_id
 * @property integer $grp_station_id
 * @property integer $c1_id
 * @property string $dues
 * @property integer $type
 * @property integer $state
 * @property integer $status
 * @property integer $position
 * @property string $created_at
 * @property string $updated_at
 */
class UserKpiModel extends \cza\base\models\ActiveRecord
{

    // const SCENARIO_COMMIT = 'commit';
    // const SCENARIO_INIT = 'init';


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_kpi}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['grp_id', 'join_user_id', 'invite_user_id', 'grp_station_id', 'c1_id', 'position'], 'integer',],
            [['dues'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['type', 'state', 'status'], 'integer', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app.c2', 'ID'),
            'grp_id' => Yii::t('app.c2', 'GRP'),
            'join_user_id' => Yii::t('app.c2', 'Join User'),
            'invite_user_id' => Yii::t('app.c2', 'Invite User'),
            'grp_station_id' => Yii::t('app.c2', 'Grp Station'),
            'c1_id' => Yii::t('app.c2', 'C1'),
            'dues' => Yii::t('app.c2', 'Dues'),
            'type' => Yii::t('app.c2', 'Type'),
            'state' => Yii::t('app.c2', 'State'),
            'status' => Yii::t('app.c2', 'Status'),
            'position' => Yii::t('app.c2', 'Position'),
            'created_at' => Yii::t('app.c2', 'Created At'),
            'updated_at' => Yii::t('app.c2', 'Updated At'),
            'checkerName' => Yii::t('app.c2', 'Checker Name'),
            'ensureCheckbox' => Yii::t('app.c2', 'Pls ensure the checkbox.'),
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\c2\query\UserKpiQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\c2\query\UserKpiQuery(get_called_class());
    }

    /**
     * setup default values
     **/
    public function loadDefaultValues($skipIfSet = true)
    {
        parent::loadDefaultValues($skipIfSet);
    }

    public function getJoinUser()
    {
        return $this->hasOne(FeUserModel::className(), ['id' => 'join_user_id']);
    }

    public function getInviteUser()
    {
        return $this->hasOne(FeUserModel::className(), ['id' => 'invite_user_id']);
    }


    public function getC1User()
    {
        return $this->hasOne(FeUserModel::className(), ['id' => 'c1_id']);
    }

    public function getCommitUser()
    {
        return $this->hasOne(BeUser::className(), ['id' => 'c1_id']);
    }

    public function isStateInit()
    {
        return ($this->state == UserKpiStateType::TYPE_NOT_COMMIT);
    }

    public function isStateAdminCommit()
    {
        return ($this->state == UserKpiStateType::TYPE_ADMIN_COMMIT);
    }

    public function getGRP()
    {
        return $this->hasOne(GRPModel::className(), ['id' => 'grp_id']);
    }

    public function getGRPStation()
    {
        return $this->hasOne(GRPStationModel::className(), ['id' => 'grp_station_id']);
    }

    public function createNewMember()
    {
        $attributes = [
            'grp_station_id' => $this->grp_station_id,
            'user_id' => $this->join_user_id,
            'label' => "",
        ];
        $model = new GRPStationItemModel();
        $model->setAttributes($attributes);
        if ($model->save()) {
            $this->updateAttributes([
                'state' => UserKpiStateType::TYPE_ADMIN_COMMIT
            ]);
            return true;
        }
       return false;
    }

    public function getProfitItem()
    {
        return $this->hasMany(UserProfitItemModel::className(), ['kpi_id' => 'id']);
    }

    public function commitProfit() {
        foreach ($this->profitItem as $item) {
            $item->updateAttributes(['state' => UserProfitState::COMMIT]);
            $item->userProfit->updateCounters(['income' => $item->income]);
        }
        $this->updateAttributes(['state' => UserKpiStateType::TYPE_FINISH_COMMIT]);
        return true;
    }

}
