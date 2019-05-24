<?php

namespace backend\models\c2\entity;

use Yii;
use cza\base\models\statics\EntityModelStatus;
use common\models\c2\entity\Warehouse as BaseModel;

/**
 * This is the model class for table "{{%warehouse}}".
 *
 * @property integer $id
 * @property string $label
 * @property string $name
 * @property string $code
 * @property string $contact_name
 * @property integer $phone
 * @property integer $eshop_id
 * @property integer $entity_id
 * @property string $entity_class
 * @property integer $country_id
 * @property integer $province_id
 * @property integer $city_id
 * @property integer $district_id
 * @property string $address
 * @property string $geo_longitude
 * @property string $geo_latitude
 * @property string $geo_marker_color
 * @property integer $state
 * @property integer $status
 * @property integer $position
 * @property string $created_at
 * @property string $updated_at
 */
class Warehouse extends BaseModel
{
    public $address_items = [];
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%warehouse}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['phone', 'eshop_id', 'entity_id', 'country_id', 'province_id', 'city_id', 'district_id', 'state', 'status', 'position'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['address_items'], 'safe'],
            [['label', 'name', 'code', 'contact_name', 'entity_class', 'address', 'geo_longitude', 'geo_latitude', 'geo_marker_color'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app.c2', 'ID'),
            'label' => Yii::t('app.c2', 'Label'),
            'name' => Yii::t('app.c2', 'Name'),
            'code' => Yii::t('app.c2', 'Code'),
            'contact_name' => Yii::t('app.c2', 'Contact Name'),
            'phone' => Yii::t('app.c2', 'Mobile Number'),
            'eshop_id' => Yii::t('app.c2', 'Eshop ID'),
            'entity_id' => Yii::t('app.c2', 'Entity ID'),
            'entity_class' => Yii::t('app.c2', 'Entity Class'),
            'country_id' => Yii::t('app.c2', 'Country ID'),
            'province_id' => Yii::t('app.c2', 'Province ID'),
            'city_id' => Yii::t('app.c2', 'City ID'),
            'district_id' => Yii::t('app.c2', 'District ID'),
            'address' => Yii::t('app.c2', 'Address'),
            'geo_longitude' => Yii::t('app.c2', 'Geo Longitude'),
            'geo_latitude' => Yii::t('app.c2', 'Geo Latitude'),
            'geo_marker_color' => Yii::t('app.c2', 'Geo Marker Color'),
            'state' => Yii::t('app.c2', 'State'),
            'status' => Yii::t('app.c2', 'Status'),
            'position' => Yii::t('app.c2', 'Position'),
            'created_at' => Yii::t('app.c2', 'Created At'),
            'updated_at' => Yii::t('app.c2', 'Updated At'),
        ];
    }
    
    /**
    * setup default values
    **/
    public function loadDefaultValues($skipIfSet = true) {
        parent::loadDefaultValues($skipIfSet);
    }

    public function getCoordinate() {
        if (isset($this->_data['coordinate'])) {
            return $this->_data['coordinate'];
        }

        if (!empty($this->geo_latitude) && !empty($this->geo_longitude)) {
            $this->_data['coordinate'] = "{$this->geo_latitude},{$this->geo_longitude}";
        } else {
            $this->_data['coordinate'] = "";
        }

        return $this->_data['coordinate'];
    }

    /**
     * in 2km range
     * @param string $lat
     * @param string $lng
     * @param integer $radius
     * @return type
     */
    public static function findRangeShops($lat, $lng, $radius = 200, $limit = 10,$extraCondition=[]) {
        $condition = "sqrt(  
            (  
             (({$lng}-geo_longitude)*PI()*12656*cos((({$lat}+geo_latitude)/2)*PI()/180)/180)  
             *  
             (({$lng}-geo_longitude)*PI()*12656*cos ((({$lat}+geo_latitude)/2)*PI()/180)/180)  
            )  
            +  
            (  
             (({$lat}-geo_latitude)*PI()*12656/180)  
             *  
             (({$lat}-geo_latitude)*PI()*12656/180)  
            )  
        )<{$radius}";
        if (!empty($extraCondition)){
            $result = static::find()->andWhere($condition)->andWhere($extraCondition)->limit($limit)->all();
        }else{
            $result = static::find()->where($condition)->limit($limit)->all();
        }

        return $result;
    }

    /**
     * limit 4 markers, refer to http://lbs.qq.com/tool/component-marker.html
     * @param string $lat
     * @param string $lng
     * @param integer $radius
     * @return string
     */
    public static function findRecentShopsPosMarks($lat, $lng, $radius = 2, $limit = 4) {
        $result = [];
        $wares = static::findRangeShops($lat, $lng, $radius, $limit);
        if(empty($wares)){
            $radius = $radius * 10;
            $wares = static::findRangeShops($lat, $lng, $radius, $limit);
            if(empty($wares)){
                $radius = $radius * 10;
                $wares = static::findRangeShops($lat, $lng, $radius, $limit);
            }
        }
        foreach ($wares as $ware) {
            $result[] = implode(';', [
                "coord:{$ware->geo_latitude},{$ware->geo_longitude}",
                "title:" . (empty($ware->label) ? " " : $ware->label),
                "addr:" . (empty($ware->profile->address) ? " " : $ware->profile->address),
            ]);
        }
        if (!empty($result)) {
            $resultStr = implode('|', $result);
        } else {
            $resultStr = implode(';', [
                "coord:{$lat},{$lng}",
                "title:" . Yii::t('app.c2', "My Position"),
                "addr:" . Yii::t('app.c2', "My Position"),
            ]);
        }
        return $resultStr;
    }

    /**
     * limit 4 markers, refer to http://lbs.qq.com/tool/component-marker.html
     * @param string $lat
     * @param string $lng
     * @param string $radius
     * @return string
     */
    public static function findRecentWareHouse($lat, $lng, $radius = 2, $limit = 4,$condition=[]) {
        //Yii::info('位置'.$lat . $lng . $radius);
            $wares = static::findRangeShops($lat, $lng, $radius, $limit,$condition);
            if(empty($wares)){
                $radius = $radius * 10;
                $wares = static::findRangeShops($lat, $lng, $radius, $limit,$condition);
                if(empty($wares)){
                    $radius = $radius * 10;
                    $wares = static::findRangeShops($lat, $lng, $radius, $limit,$condition);
                }
            }
            return is_array($wares)?(isset($wares[0])?$wares[0]:Warehouse::find()->andWhere(['entity_id'=>intval(Yii::$app->settings->get('biz\general_shop')),'entity_class'=> Shop::className(),'status' => EntityModelStatus::STATUS_ACTIVE])->one()):$wares;
    }

    public function loadAddressItems() {
        $this->address_items = $this->getAddressItems()->asArray()->all();
    }
    
    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);
        if (!empty($this->address_items)) {
            foreach ($this->address_items as $item) {
                $attributes = [
                    'warehouse_id' => $this->id,
                    'city_id' => $item['city_id'],
                    'position' => isset($item['position']) ? $item['position'] : 50,
                    'status' => EntityModelStatus::STATUS_ACTIVE
                ]; 
                $rsModel = \common\models\c2\entity\WarehouseAddRs::find()->where(['warehouse_id' => $this->id])->andWhere(['city_id' => $item['city_id']])->one();
                Yii::info($rsModel);
                if (is_null($rsModel)) {
                    $itemModel = new \common\models\c2\entity\WarehouseAddRs();
                    $itemModel->loadDefaultValues();
                    $itemModel->setAttributes($attributes);
                    $itemModel->link('warehouse', $this);
                } else {
                    if (!is_null($rsModel)) {
                        $rsModel->updateAttributes($attributes);
                    }
                }
            }
        }
    }
}
