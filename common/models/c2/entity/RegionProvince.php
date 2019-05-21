<?php

namespace common\models\c2\entity;

use Yii;
use common\models\c2\statics\FeUserType;
use cza\base\models\statics\EntityModelStatus;
use common\models\c2\statics\RegionType;
use yii\helpers\ArrayHelper;

class RegionProvince extends RegionModel
{
    public $_data = [];
    public $date_to;

    protected static $_cacheData = [];

    public function loadDefaultValues($skipIfSet = true)
    {
        parent::loadDefaultValues($skipIfSet);
        $this->type = RegionType::TYPE_PROVINCE;
    }

    public static function find()
    {
        return parent::find()->provinces()->orderBy(['position' => SORT_DESC, 'label' => SORT_ASC]);
    }

    public function getCitys()
    {
        return $this->hasMany(RegionCity::className(), ['id' => 'child_id'])
            ->where(['status' => \cza\base\models\statics\EntityModelStatus::STATUS_ACTIVE])
            ->viaTable('{{%region_rs}}', ['parent_id' => 'id']);
    }

    public function getDistributors()
    {
        return $this->hasMany(Distributor::className(), ['province_id' => 'id'])
            ->where(['{{%fe_user}}.status' => EntityModelStatus::STATUS_ACTIVE]);
    }

    public function getSalesman()
    {
        return $this->hasMany(Salesman::className(), ['province_id' => 'id'])
            ->where(['{{%fe_user}}.status' => EntityModelStatus::STATUS_ACTIVE]);
    }


    public function getProvinceLabel($province)
    {
        return static::find()->select('label')->where(['id' => $province])->scalar();
    }

    /**
     *
     * @param type $keyField
     * @param type $valField - could be string or alias array
     * @return type
     */
    public function getCityHashMap($keyField = 'id', $valField = 'label')
    {
        return ArrayHelper::map($this->getCitys()->select([$keyField, $valField])->asArray()->all(), $keyField, $valField);
    }

    public function getCustomerAllByProvince()
    {
        $Salesmans = Salesman::find()->select('id,province_id')->all();
        $customer = [];
        foreach ($Salesmans as $item => $salesman) {
            if (isset($customer[$salesman->province_id])) {
                $customer[$salesman->province_id]['customer_num'] += $salesman->getCustomersCount();
            } else {
                $customer[$salesman->province_id]['label'] = $this->getProvinceLabel($salesman->province_id);
                $customer[$salesman->province_id]['customer_num'] = $salesman->getCustomersCount();
            }
        }
        return $customer;
    }

    /**
     * return index array order by customer numbers
     */
    public static function statSalesmans()
    {
        $data = [];
        $items = static::getAll();
        foreach ($items as $item) {
            $data[] = [
                'id' => $item->id,
                'label' => $item->label,
                'count' => $item->countLocalSalesmans(),
            ];
        }

        static::sort($data);
        return $data;
    }

    /**
     * return index array order by customer numbers
     */
    public static function statCustomers()
    {
        $data = [];
        $items = static::getAll();
        foreach ($items as $item) {
            $data[] = [
                'id' => $item->id,
                'label' => $item->label,
                'count' => $item->countLocalCustomers(),
            ];
        }

        static::sort($data);
        return $data;
    }

    /**
     * return index array order by customer numbers
     */
    public static function statSalesAmount()
    {
        $data = [];
        $items = static::getAll();
        foreach ($items as $item) {
            $data[] = [
                'id' => $item->id,
                'label' => $item->label,
                'count' => $item->countLocalSalesAmount(),
            ];
        }

        static::sort($data);
        return $data;
    }

    public static function getAll()
    {
        if (!isset(static::$_cacheData['all'])) {
            static::$_cacheData['all'] = static::find()->all();
        }
        return static::$_cacheData['all'];
    }

    public static function sort(&$data)
    {
        usort($data, function ($a, $b) {
            $cA = $a['count'];
            $cB = $b['count'];
            if ($cA == $cB) {
                return 0;
            }
            return ($cA < $cB) ? -1 : 1;
        });
    }

    public function countLocalCustomers()
    {
        $count = 0;

        foreach ($this->distributors as $distributor) {
            $count += $distributor->getCustomerCount();
        }
        return $count;
    }

    public function countLocalSalesmans()
    {
        $count = 0;

        foreach ($this->distributors as $distributor) {
            $count += $distributor->getSalesmanCount();
        }
        return $count;
    }

    public function countLocalSalesAmount()
    {
        $count = 0;

        foreach ($this->distributors as $distributor) {
            $count += $distributor->getConsumeTotal();
        }
        return $count;
    }

    public function getDistributorsCount($province = "")
    {
        $condition = ['and', ['province_id' => $province, 'type' => FeUserType::TYPE_DISTRIBUTOR]];
        return FeUser::find()->andWhere($condition)->count();
    }

    public function getAddDistributorsCount($province = "")
    {
        $condition = ['And', ['province_id' => $province, 'type' => FeUserType::TYPE_DISTRIBUTOR]];
        return FeUser::find()->where($condition)->andWhere($this->getTodayCondition())->count();
    }

    public function getFranchiseeCount($province = "")
    {
        $condition = ['and', ['province_id' => $province, 'type' => FeUserType::TYPE_FRANCHISEE]];
        return FeUser::find()->andWhere($condition)->count();
    }

    public function getAddFranchiseeCount($province = "")
    {
        $condition = ['and', ['province_id' => $province, 'type' => FeUserType::TYPE_FRANCHISEE]];
        return FeUser::find()->where($condition)->andWhere($this->getTodayCondition())->count();
    }

    public function getShop($province = "")
    {
        $condition = ['and', ['province_id' => $province, 'status' => EntityModelStatus::STATUS_ACTIVE]];
        return Shop::find()->where($condition)->count();
    }

    public function getAddShop($province = "")
    {
        $condition = ['and', ['province_id' => $province, 'status' => EntityModelStatus::STATUS_ACTIVE]];
        return Shop::find()->where($condition)->andWhere($this->getTodayCondition())->count();
    }

    public function getBizmanager($province = "")
    {

        return BizManager::find()->andWhere(['province_id' => $province])->count();
    }

    public function getAddBizmanager($province = "")
    {
        $condition = ['and', ['province_id' => $province, 'type' => FeUserType::TYPE_DISTRIBUTOR]];
        $distributors = Distributor::find()->andWhere($condition)->all();
        $bizmanagers = '';
        foreach ($distributors as $distributor) {
            $bizmanagers += $distributor->getBizManagerNum($this->getTodayCondition());

        }
        return $bizmanagers;
    }

    public function getSalesmanCount($province = "")
    {
        $condition = ['and', ['province_id' => $province, 'type' => FeUserType::TYPE_DISTRIBUTOR]];
        $distributors = Distributor::find()->andWhere($condition)->all();
        $salesmans = '';
        foreach ($distributors as $distributor) {
            $salesmans += $distributor->getSalesmansNum();
        }
        return $salesmans;
    }

    public function getAddSalesmanCount($province = "")
    {
        $condition = ['and', ['province_id' => $province, 'type' => FeUserType::TYPE_DISTRIBUTOR]];
        $distributors = Distributor::find()->andWhere($condition)->all();
        $salesmans = '';
        foreach ($distributors as $distributor) {
            $salesmans += $distributor->getSalesmansNum($this->getTodayCondition());
        }
        return $salesmans;
    }

    public function getCustomer($province = "")
    {
        $condition = ['and', ['province_id' => $province, 'type' => FeUserType::TYPE_DISTRIBUTOR]];
        $distributors = Distributor::find()->andWhere($condition)->all();
        $favouredCustomer = '';
        $bizCustomer = '';
        foreach ($distributors as $distributor) {
            $favouredCustomer += $distributor->getCustomersNum();
            $bizCustomer += $distributor->getBizCustomer($distributor);
        }
        $customer = $favouredCustomer + $bizCustomer;
        return $customer;
    }

    public function getAddCustomer($province = "")
    {
        $condition = ['and', ['province_id' => $province, 'type' => FeUserType::TYPE_DISTRIBUTOR]];
        $distributors = Distributor::find()->andWhere($condition)->all();
        $favouredCustomer = '';
        $bizCustomer = '';
        foreach ($distributors as $distributor) {
            $favouredCustomer += $distributor->getCustomersNum($this->getTodayCondition());
            $bizCustomer += $distributor->getBizCustomer($distributor, $this->getTodayCondition());
        }
        $customer = $favouredCustomer + $bizCustomer;
        return $customer;
    }

    public function getConsumptionRecord($province = "")
    {
        $condition = ['and', ['province_id' => $province, 'type' => FeUserType::TYPE_DISTRIBUTOR]];
        $distributors = Distributor::find()->andWhere($condition)->all();
        $consumption = "";
        foreach ($distributors as $distributor) {
            $consumption += $distributor->getConsumeTotal();
        }
        return $consumption;
    }

    public function getTodayCondition()
    {
        if (!isset($this->_data['todaycondition'])) {
            $this->_data['todaycondition'] = [
                'AND',
                ['between', 'created_at', date('Y-m-d 00:00', strtotime($this->date_to)), date('Y-m-d 23:59', strtotime($this->date_to))]
            ];
        }
        return $this->_data['todaycondition'];
    }

    public function getCityArr()
    {
        $data = [];
        foreach ($this->getCitys()->all() as $item => $city) {
            $data[$item] = [
                'name' => $city->label,
                'pid' => (int)$this->id,
                'id' => (int)$city->id,
                'districtList' => $city->getDistrictsArr()
            ];
        }
        return $data;
    }
}
