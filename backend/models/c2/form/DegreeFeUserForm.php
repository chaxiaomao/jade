<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/2
 * Time: 16:20
 */

namespace backend\models\c2\form;


use common\models\c2\entity\FeUserModel;
use cza\base\models\ModelTrait;
use yii\base\Model;

class DegreeFeUserForm extends Model
{
    use ModelTrait;
    public $degree;

    public function init() {
        parent::init();
        $this->loadDefaultValues();
    }

    public function loadDefaultValues() {

    }

}