<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/27
 * Time: 11:53
 */

namespace common\models\c2\entity;


use cza\base\models\statics\EntityModelStatus;

class LordProfileModel extends FeUserProfileModel
{

    public function getAllLord()
    {
        return $this->hasMany(LordModel::className(), ['id' => 'user_id'])
            ->where(['{{%fe_user}}.status' => EntityModelStatus::STATUS_ACTIVE]);
    }
}