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

class ChieftainModel extends FeUserModel
{
    public function loadDefaultValues($skipIfSet = true) {
        parent::loadDefaultValues($skipIfSet);
        $this->type = FeUserType::TYPE_CHIEFTAIN;
    }

    /**
     * @inheritdoc
     * @return \common\models\c2\query\FeUserQuery the active query used by this AR class.
     */
    public static function find() {
        return parent::find()->chieftains();
    }

    public static function getHashMap($keyField, $valField, $condition = '') {
        if (empty($_data['chieftainHashMap'])) {
            $lord = ChieftainProfileModel::find()->joinWith(['allChieftain'])
                ->andWhere(['{{%fe_user}}.type' => FeUserType::TYPE_CHIEFTAIN]);
            $_data['chieftainHashMap'] = ArrayHelper::map($lord->select([$keyField, $valField])->andWhere($condition)->asArray()->all(), $keyField, $valField);
            return $_data['chieftainHashMap'];
        }
    }

}