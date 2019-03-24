<?php

namespace backend\models\c2\form;

use Yii;
use yii\base\Model;
use cza\base\models\ModelTrait;
use yii\validators\Validator;
use common\models\c2\entity\Product;
use common\models\c2\entity\AssociatedProduct;

class AssociatedProductsForm extends Model {
    
    use ModelTrait;
    
    public $child_ids;
    public $entityModel = null;
    
    public function init() {
        parent::init();
        $this->loadDefaultValues();
    }

    public function loadDefaultValues() {
        $associationModelClass = AssociatedProduct::className();
        $associationChilds = $associationModelClass::find()->where(['parent_id' => $this->entityModel->id])->select(['child_id'])->asArray()->all();
        foreach ($associationChilds as $key => $val) {
            $this->child_ids[] = $val['child_id'];
        }
//        $associationParents = $associationModelClass::find()->where(['child_id' => $this->entityModel->id])->select(['parent_id'])->asArray()->all();
//        foreach ($associationParents as $key => $val) {
//            $this->child_ids[] = $val['parent_id'];
//        }
    }
    
    public function save($params, $id) {
        $associationModelClass = AssociatedProduct::className();
//        $associatedParents = $associationModelClass::find()->where(['child_id' => $id])->select(['parent_id'])->asArray()->all();
        $associatedChilds = $associationModelClass::find()->where(['parent_id' => $id])->select(['child_id'])->asArray()->all();
        $associatedChildIds = [];
        $associatedParentIds = [];
        
        foreach ($associatedChilds as $key => $val) {
            $associatedChildIds[] = $val['child_id'];
        }
        
//        foreach ($associatedParents as $key => $val) {
//            $associatedParentIds[] = $val['parent_id'];
//        }
        if (!empty($params['child_ids'])) {
            $params['child_ids'] = array_unique($params['child_ids']);
            foreach ($params['child_ids'] as $key => $val) {
                if (!in_array($val, $associatedChildIds)) {
                    $associationModel = new AssociatedProduct();
                    $associationModel->setAttributes([
                        'parent_id' => $id,
                        'child_id' => $val,
                    ]);
                    $associationModel->save();
                }
            }
            
            foreach ($associatedChildIds as $key => $val) {
                if (!in_array($val, $params['child_ids'])) {
                    $olds = $associationModelClass::findAll(['parent_id' => $id, 'child_id' => $val]);
                    foreach ($olds as $old) {
                        $old->delete();
                    }
                }
            }
            
//            foreach ($associatedParentIds as $key => $val) {
//                if (!in_array($val, $params['child_ids'])) {
//                    $olds = $associationModelClass::findAll(['child_id' => $id, 'parent_id' => $val]);
//                    foreach ($olds as $old) {
//                        $old->delete();
//                    }
//                }
//            }
            
        } else {
            $asOldParent = $associationModelClass::find()->where(['parent_id' => $id])->all();
//            $asOldChild = $associationModelClass::find()->where(['child_id' => $id])->all();
            foreach ($asOldParent as $old) {
                $old->delete();
            }
//            foreach ($asOldChild as $old) {
//                $old->delete();
//            }
        }
        
        
        return true;
    }
}