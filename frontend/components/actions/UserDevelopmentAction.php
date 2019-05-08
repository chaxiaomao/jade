<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/8
 * Time: 10:11
 */

namespace frontend\components\actions;

class UserDevelopmentAction extends \yii\base\Action
{

    public function run()
    {
        $user = \Yii::$app->user->currentUser;
        return $user->getUserDevelopmentTreeData();
    }
}