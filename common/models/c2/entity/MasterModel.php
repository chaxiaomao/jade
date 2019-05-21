<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/26
 * Time: 17:34
 */

namespace common\models\c2\entity;


use common\models\c2\statics\FeUserType;
use cza\base\models\statics\EntityModelStatus;
use yii\helpers\ArrayHelper;

class MasterModel extends FeUserModel
{
    public $chieftainId;
    public $chessId;
    public $degreeId;

    public function loadDefaultValues($skipIfSet = true) {
        parent::loadDefaultValues($skipIfSet);
        $this->type = FeUserType::TYPE_MASTER;
    }

    /**
     * @inheritdoc
     * @return \common\models\c2\query\FeUserQuery the active query used by this AR class.
     */
    public static function find() {
        return parent::find()->master();
    }

    public static function getHashMap($keyField, $valField, $condition = '') {
        if (empty($_data['masterHashMap'])) {
            $lord = MasterProfileModel::find()->joinWith(['allMaster'])
                ->andWhere(['{{%fe_user}}.type' => FeUserType::TYPE_MASTER]);
            $_data['masterHashMap'] = ArrayHelper::map($lord->select([$keyField, $valField])->andWhere($condition)->asArray()->all(), $keyField, $valField);
            return $_data['masterHashMap'];
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
        if ($insert) {
            $rs = new ChieftainMasterRsModel();
            $rs->setAttributes([
                'chess_id' => $this->chessId,
                'chieftain_id' => $this->chieftainId,
                'master_id' => $this->id,
            ]);
            $rs->save();
            $rs2 = new UserDegreeRsModel();
            $rs2->setAttributes([
                'use_id' => $this->id,
                'degree_id' => $this->degreeId,
                'type' => $this->type,
            ]);
            $rs2->save();
        }
    }

    public function getFamiliars()
    {
        return $this->hasMany(FamiliarModel::className(), ['id' => 'familiar_id'])
            ->where(['status' => EntityModelStatus::STATUS_ACTIVE])
            ->viaTable('{{%master_familiar_rs}}', ['master_id' => 'id']);
    }

    public function getCurrentChessUser()
    {
        $currentChess = \Yii::$app->session->get('chess');
        return $this->getFamiliars()->where(['chess_id' => $currentChess['chess_id']]);
    }

}