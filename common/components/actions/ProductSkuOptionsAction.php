<?php

namespace common\components\actions;

use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\FileHelper;
use yii\helpers\Url;
use common\models\c2\entity\Product;

/**
 * Get product skus according to product id
 * be used to retrive kartik\widgets\DepDrop sub options
 *
 *
 * @author Ben Bi <ben@cciza.com>
 * @link http://www.cciza.com/
 * @copyright 2014-2016 CCIZA Software LLC
 * @license
 */
class ProductSkuOptionsAction extends \yii\base\Action {

    public $keyAttribute = 'id';
    public $valueAttribute = 'label';
    public $queryAttribute = 'depdrop_parents';
    public $checkAccess;
    public $withPrice = false;

    /**
     * @var callable a PHP callable that will be called to prepare a data provider that
     * should return a collection of the models. If not set, [[prepareDataProvider()]] will be used instead.
     * The signature of the callable should be:
     *
     * ```php
     * function ($action) {
     *     // $action is the action object currently running
     * }
     * ```
     *
     * The callable should return an instance of [[ActiveDataProvider]].
     */

    /**
     * @return array
     */
    public function run() {
        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id);
        }

        $params = Yii::$app->request->post();
        return $this->prepareDataProvider($params);
    }

    /**
     * Prepares the data provider that should return the requested collection of the models.
     * @return array
     */
    protected function prepareDataProvider($params = []) {
        if (!isset($params['depdrop_all_params'])) {
            throw new \Exception('Require parameter "depdrop_all_params"!');
        }
        if (!isset($params['depdrop_parents'])) {
            throw new Exception('Require parameter "depdrop_parents"!');
        }

        $model = Product::findOne(['id' => $params['depdrop_all_params']['product_id']]);

        $result = [
            'output' => [],
            'seletcted' => "",
        ];

        $options = [];
//            $options = $model->getProductSkus()->select([$this->keyAttribute, 'name' => $this->valueAttribute])->asArray()->all();
//        $items = $model->getProductSkuOptionsList($this->keyAttribute, $this->valueAttribute, ['withPrice' => $this->withPrice]);
//        foreach ($items as $k => $v) {
//            $options[] = [
//                'id' => $k,
//                'name' => $v,
//            ];
//        }

        foreach ($model->productSkus as $model) {
            $options[] = [
                'id' => $model->id,
                'name' => $model->name . " (" . $model->getPrice() . Yii::t('app.c2', 'Yuan') . ")",
                'price' => $model->getPrice(),
            ];
        }

        $result['output'] = $options;
        return $this->controller->asJson($result);
    }

}
