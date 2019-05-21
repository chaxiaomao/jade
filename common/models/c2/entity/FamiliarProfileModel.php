<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/27
 * Time: 11:53
 */

namespace common\models\c2\entity;


use cza\base\models\statics\EntityModelStatus;

class FamiliarProfileModel extends FeUserProfileModel
{

    public function getAllFamiliar()
    {
        return $this->hasMany(FamiliarModel::className(), ['id' => 'user_id'])
            ->where(['{{%fe_user}}.status' => EntityModelStatus::STATUS_ACTIVE]);
    }
}