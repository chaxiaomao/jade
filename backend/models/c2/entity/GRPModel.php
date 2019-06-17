<?php
/**
 * Created by PhpStorm.
 * User: jerrygo
 * Date: 19-6-7
 * Time: 上午7:26
 */

namespace backend\models\c2\entity;


use common\models\c2\entity\GRPBranchModel;
use common\models\c2\statics\GRPType;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * Class GRPModel Branch GRP Model.
 * @package backend\models\c2\entity
 */
class GRPModel extends \common\models\c2\entity\GRPModel
{
    public $branchItems;
    public $parentId;
    public $grpId;

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['parentId'], 'required'],
        ]);
    }

    public function getGRPBranchJson($grpId)
    {
        $root = GRPBranchModel::findOne(['children_id' => $this->id]);
        $this->branchItems = GRPBranchModel::findAll(['grp_id' => $grpId]);
        // \Yii::info($this->branchItems);
        if (!is_null($root)) {
            $data = [
                'id' => $root->childrenGRP->id,
                'name' => $root->childrenGRP->label,
                'parent_id' => $root->parent_id,
                'children' => $this->getGRPBranchChildren($root),
            ];
        } else {
            $data = [
                'id' => $this->id,
                'name' => $this->label,
                'parent_id' => $this->id,
                'children' => [],
            ];
        }

        // Yii::info($data);
        return Json::encode($data);
        // return json_encode($data);
    }

    public function getGRPBranchChildren($parent)
    {
        $rec = [];
        foreach ($this->branchItems as $branchItem) {
            if ($branchItem->parent_id == $parent->children_id) {
                $children = [];
                if ($this->isHasChildren($branchItem)) {
                    $children = $this->getGRPBranchChildren($branchItem);
                }
                $rec[] = [
                    'id' => $branchItem->childrenGRP->id,
                    'name' => $branchItem->childrenGRP->label,
                    'parent_id' => $branchItem->parent_id,
                    'children' => $children
                ];
            }
        }
        return $rec;
    }

    public function isHasChildren($parent)
    {
        foreach ($this->branchItems as $branchItem) {
            if ($branchItem->parent_id == $parent->children_id) {
                return true;
            }
        }
        return false;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
        if ($this->type == GRPType::TYPE_BRANCH) {
            $attributes = [
                'grp_id' => $this->grpId,
                'children_id' => $this->id,
                'parent_id' => $this->parentId,
            ];
            $model = new GRPBranchModel();
            $model->setAttributes($attributes);
            $model->save();
        }
    }

}