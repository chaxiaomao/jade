<?php

namespace common\models\c2\entity;

use common\models\c2\statics\FeUserType;
use common\models\c2\statics\UserKpiStateType;
use common\models\c2\statics\UserProfitType;
use cza\base\models\statics\EntityModelStatus;
use frontend\models\FeUser;
use Yii;

/**
 * This is the model class for table "{{%user_kpi}}".
 *
 * @property string $id
 * @property string $chess_id
 * @property string $user_id
 * @property string $recommend_user_id
 * @property string $familiar_id
 * @property string $chieftain_id
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

    public $items;
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
            [['chess_id', 'user_id', 'recommend_user_id', 'position', 'chieftain_id', 'familiar_id',], 'integer'],
            [['created_at', 'updated_at', 'dues'], 'safe'],
            [['dues',], 'number'],
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
            'chess_id' => Yii::t('app.c2', 'Chess ID'),
            'user_id' => Yii::t('app.c2', 'User ID'),
            'recommend_user_id' => Yii::t('app.c2', 'Recommend user ID'),
            'type' => Yii::t('app.c2', 'Type'),
            'state' => Yii::t('app.c2', 'State'),
            'status' => Yii::t('app.c2', 'Status'),
            'dues' => Yii::t('app.c2', 'Dues'),
            'position' => Yii::t('app.c2', 'Position'),
            'created_at' => Yii::t('app.c2', 'Created At'),
            'updated_at' => Yii::t('app.c2', 'Updated At'),
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
    public function loadDefaultValues($skipIfSet = true) {
        parent::loadDefaultValues($skipIfSet);
    }

    public function getUser()
    {
        return $this->hasOne(FeUserModel::className(), ['id' => 'user_id']);
    }

    public function getRecommendUser()
    {
        return $this->hasOne(FeUserModel::className(), ['id' => 'recommend_user_id']);
    }

    public function getChieftain() {
        return $this->hasOne(FeUserModel::className(), ['id' => 'chieftain_id']);
    }

    public function getChess()
    {
        return $this->hasOne(ChessModel::className(), ['id' => 'chess_id']);
    }

    public function getFamiliar()
    {
        return $this->hasOne(FeUserModel::className(), ['id' => 'familiar_id']);
    }

    public function getProfitItem()
    {
        return $this->hasOne(UserProfitItemModel::className(), ['kpi_id' => 'id']);
    }

    public function isChieftainCommit()
    {
        return ($this->state == UserKpiStateType::TYPE_CHIEFTAIN_COMMIT);
    }

    public function isAdminCommit()
    {
        return ($this->state == UserKpiStateType::TYPE_ADMIN_COMMIT);
    }

    public function getFamiliarStation()
    {
        return $this->hasOne(UserChessRsModel::className(), ['user_id' => 'familiar_id']);
    }

    /**
     * @param $chess_id
     * @return FeUserModel
     */
    public function getOwnerFamiliar($chess_id)
    {
        // Create the common arrange & jump arrange regulation position for peasant.
        $familiarModels = UserChessRsModel::find()->where(['chess_id' => $chess_id, 'type' => FeUserType::TYPE_FAMILIAR])
            ->andFilterWhere(['status' => EntityModelStatus::STATUS_ACTIVE])
            ->orderBy(['position' => SORT_ASC])
            ->asArray()
            ->all();
        $peasantModels = UserChessRsModel::find()->where(['chess_id' => $chess_id, 'type' => FeUserType::TYPE_PEASANT])
            ->andFilterWhere(['status' => EntityModelStatus::STATUS_ACTIVE])
            ->all();
        $currentUserPosition = count($peasantModels) + 1;
        $iBaseNum = 1;
        $familiarIndex = -1;
        for ($i = 0; $i < 3; $i++) {
            $kBaseNum = $iBaseNum;
            for ($j = 0; $j < 3; $j++) {
                $familiarIndex++;
                for ($k = 0; $k < 3; $k++) {
                    if ($currentUserPosition == $kBaseNum + $j * 9) {
                        $user_id = $familiarModels[$familiarIndex]['user_id'];
                        return FeUserModel::findOne($user_id);
                        break;
                    }
                }
                $kBaseNum += 3;
            }
            $iBaseNum++;
        }
        return null;
    }

    public function getOwnerMasters($recommend_user_id, $chess_id)
    {
        $models = UserDevelopmentModel::find()->where(['chess_id' => $chess_id, 'user_id' => $recommend_user_id])->all();
        $parentModels = [];
        foreach ($models as $model) {
            array_push($parentModels, $model->parent);
        }
        return $parentModels;
    }

    public function deleteProfitItems()
    {
        foreach ($this->getProfitItem()->all() as $item) {
            $item->delete();
        }
    }

    public function setKpiStateAdminCommit()
    {
        foreach ($this->getProfitItem()->all() as $item) {
            $item->updateAttributes([
                'state' => UserKpiStateType::TYPE_ADMIN_COMMIT
            ]);
        }
        $this->updateAttributes(['state' => UserKpiStateType::TYPE_ADMIN_COMMIT]);
        return true;
    }

    public function setKpiStateFinishCommit()
    {
        $model1 = new UserChessRsModel();
        $model1->setAttributes([
            'user_id' => $this->user_id,
            'chess_id' => $this->chess_id,
            'type' => $this->type,
        ]);

        $model2 = new UserDevelopmentModel();
        $model2->setAttributes([
            'user_chess_rs_id' => $this->familiarStation->id,
            'chess_id' => $this->chess_id,
            'user_id' => $this->user_id,
            'type' => $this->type,
        ]);

        if ($model1->save() && $model2->save()) {
            $this->updateAttributes(['state' => UserKpiStateType::TYPE_FINISH_COMMIT]);
            foreach ($this->getProfitItem()->all() as $item) {
                $item->updateAttributes([
                    'state' => UserKpiStateType::TYPE_FINISH_COMMIT
                ]);
            }
            return true;
        }
        return null;
    }

    public function setKpiStateChieftainCommit()
    {
        if (!empty($this->items)) {
            foreach ($this->items as $item) {
                $attrs = [
                    'type' => isset($item['type']) ? $item['type'] : UserProfitType::TYPE_PROFIT,
                    'kpi_id' => $this->id,
                    'user_id' => $item['user_id'],
                    'chess_id' => $this->chess_id,
                    'income' => $item['income'],
                    'state' => UserKpiStateType::TYPE_CHIEFTAIN_COMMIT
                ];
                $model = new UserProfitItemModel();
                $model->setAttributes($attrs);
                $model->save();
            }
        }
        $this->updateAttributes(['state' => UserKpiStateType::TYPE_CHIEFTAIN_COMMIT]);
        return true;
    }

}
