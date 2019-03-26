<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/26
 * Time: 17:34
 */

namespace common\models\c2\entity;


use common\models\c2\statics\FeUserType;

class LordModel extends FeUserModel
{
    public function loadDefaultValues($skipIfSet = true) {
        parent::loadDefaultValues($skipIfSet);
        $this->type = FeUserType::TYPE_LORD;
    }

}