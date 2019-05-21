<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/6
 * Time: 11:17
 */

namespace backend\models\c2\form;


use common\models\c2\entity\UserChessRsModel;
use common\models\c2\entity\UserDevelopmentModel;
use common\models\c2\entity\UserKpiModel;
use common\models\c2\entity\UserProfitItemModel;
use common\models\c2\statics\UserKpiStateType;
use common\models\c2\statics\UserProfitType;
use cza\base\models\ModelTrait;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class KpiCommitForm extends UserKpiModel
{
    use ModelTrait;

    public $code;
    public $items;

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            ['items', 'validateItems']
        ]);
    }

    public function loadItems()
    {
        $this->items = $this->getProfitItem()->all();
    }

    public function validateItems($attributeNames)
    {

    }

    public function afterSave($insert, $changedAttributes)
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
                if (isset($item['id']) && $item['id'] != '') {
                    $model = UserProfitItemModel::findOne($item['id']);
                    $model->updateAttributes($attrs);
                }
            }
        }
    }

}