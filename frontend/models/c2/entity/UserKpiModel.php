<?php
/**
 * Created by PhpStorm.
 * User: jerrygo
 * Date: 19-5-28
 * Time: 下午7:42
 */
namespace frontend\models\c2\entity;

use Yii;
use yii\helpers\ArrayHelper;

class UserKpiModel extends \common\models\c2\entity\UserKpiModel
{

    public $checkerName;
    public $ensureCheckbox = false;

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['checkerName', 'ensureCheckbox', 'dues', 'grp_station_id'], 'required',],
            [['ensureCheckbox'], 'validateEnsureCheckbox',],
        ]);
    }

    public function validateEnsureCheckbox($attribute, $params)
    {
        if ($this->$attribute != 1) {
            $this->addError($this->$attribute, Yii::t('app.c2', 'Pls ensure the checkbox.'));
        }
    }

}