<?php

namespace backend\models\c2\form;

use Yii;
use yii\base\Model;
use cza\base\models\ModelTrait;
use yii\helpers\ArrayHelper;

class HotSearchProductForm extends Model {

    use ModelTrait;

    public $product_ids = [];
    public $category_id;
    public $entityModel = null;

    public function init() {
        parent::init();
        $this->loadDefaultValues();
    }

    public function loadDefaultValues() {

        $hotSaleProduct = \common\models\c2\entity\CategoryPromoProductRs::find()->where(['category_id' => $this->entityModel->id, 'type' => \common\models\c2\statics\CategoryPromoProductType::TYPE_HOT_SEARCH])->asArray()->all();
        $this->product_ids = ArrayHelper::getColumn($hotSaleProduct, 'product_id') ? ArrayHelper::getColumn($hotSaleProduct, 'product_id') : [];
    }

    public function save($params, $id) {

        if (empty($params['product_ids'])) {
            \common\models\c2\entity\CategoryPromoProductRs::deleteAll(['in', 'product_id', $this->product_ids]);
            return true;
        }
        foreach ($params['product_ids'] as $k => $key) {
            if (!in_array($key, $this->product_ids)) {
                $hotSaleProduct = new \common\models\c2\entity\CategoryPromoProductRs();
                $hotSaleProduct->setAttributes([
                    'product_id' => $key,
                    'category_id' => $id,
                    'type' => \common\models\c2\statics\CategoryPromoProductType::TYPE_HOT_SEARCH
                ]);
                $hotSaleProduct->save(false);
            }
        }
        $del = array_diff($this->product_ids, $params['product_ids']);
        \common\models\c2\entity\CategoryPromoProductRs::deleteAll(['in', 'product_id', $del]);
        
        return true;
        
    }

}
