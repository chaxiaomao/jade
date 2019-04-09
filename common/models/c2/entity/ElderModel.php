<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/26
 * Time: 17:34
 */

namespace common\models\c2\entity;


use common\helpers\DeviceLogHelper;
use common\models\c2\statics\FeUserType;
use cza\base\models\statics\EntityModelStatus;
use yii\helpers\ArrayHelper;

class ElderModel extends FeUserModel
{
    public $lordId;

    public function loadDefaultValues($skipIfSet = true) {
        parent::loadDefaultValues($skipIfSet);
        $this->type = FeUserType::TYPE_ELDER;
    }

    /**
     * @inheritdoc
     * @return \common\models\c2\query\FeUserQuery the active query used by this AR class.
     */
    public static function find() {
        return parent::find()->elders();
    }

    public static function getHashMap($keyField, $valField, $condition = '') {
        if (empty($_data['elderHashMap'])) {
            $lord = ElderProfileModel::find()->joinWith(['allElder'])
                ->andWhere(['{{%fe_user}}.type' => FeUserType::TYPE_ELDER]);
            $_data['elderHashMap'] = ArrayHelper::map($lord->select([$keyField, $valField])->andWhere($condition)->asArray()->all(), $keyField, $valField);
            return $_data['elderHashMap'];
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
        if ($insert) {
            $rs = new LordElderRsModel();
            $rs->setAttributes([
                'lord_id' => $this->lordId,
                'elder_id' => $this->id,
            ]);
            $rs->save();
        }
    }

    public function getChieftain()
    {
        return $this->hasMany(ChieftainModel::className(), ['id' => 'chieftain_id'])
            ->where(['status' => EntityModelStatus::STATUS_ACTIVE])
            ->viaTable('{{%elder_chieftain_rs}}', ['elder_id' => 'id']);
    }

}