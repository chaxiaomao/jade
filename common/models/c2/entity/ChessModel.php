<?php

namespace common\models\c2\entity;

use Yii;

/**
 * This is the model class for table "{{%chess}}".
 *
 * @property string $id
 * @property integer $type
 * @property string $lv6_id
 * @property string $lv5_id
 * @property string $lv4_id
 * @property string $attributeset_id
 * @property string $province_id
 * @property string $city_id
 * @property string $district_id
 * @property string $code
 * @property string $label
 * @property string $biz_registration_number
 * @property string $product_style
 * @property string $tel
 * @property string $open_id
 * @property string $wechat_open_id
 * @property string $geo_longitude
 * @property string $geo_latitude
 * @property string $geo_marker_color
 * @property string $created_by
 * @property string $updated_by
 * @property integer $status
 * @property integer $position
 * @property string $created_at
 * @property string $updated_at
 */
class ChessModel extends \cza\base\models\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%chess}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lv6_id', 'lv5_id', 'lv4_id', 'attributeset_id', 'province_id', 'city_id', 'district_id', 'created_by', 'updated_by', 'position'], 'integer'],
            [['label'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['type', 'status'], 'string', 'max' => 4],
            [['code', 'label', 'biz_registration_number', 'product_style', 'tel', 'open_id', 'wechat_open_id', 'geo_longitude', 'geo_latitude', 'geo_marker_color'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app.c2', 'ID'),
            'type' => Yii::t('app.c2', 'Type'),
            'lv6_id' => Yii::t('app.c2', 'Lv6 ID'),
            'lv5_id' => Yii::t('app.c2', 'Lv5 ID'),
            'lv4_id' => Yii::t('app.c2', 'Lv4 ID'),
            'attributeset_id' => Yii::t('app.c2', 'Attributeset ID'),
            'province_id' => Yii::t('app.c2', 'Province ID'),
            'city_id' => Yii::t('app.c2', 'City ID'),
            'district_id' => Yii::t('app.c2', 'District ID'),
            'code' => Yii::t('app.c2', 'Code'),
            'label' => Yii::t('app.c2', 'Label'),
            'biz_registration_number' => Yii::t('app.c2', 'Biz Registration Number'),
            'product_style' => Yii::t('app.c2', 'Product Style'),
            'tel' => Yii::t('app.c2', 'Tel'),
            'open_id' => Yii::t('app.c2', 'Open ID'),
            'wechat_open_id' => Yii::t('app.c2', 'Wechat Open ID'),
            'geo_longitude' => Yii::t('app.c2', 'Geo Longitude'),
            'geo_latitude' => Yii::t('app.c2', 'Geo Latitude'),
            'geo_marker_color' => Yii::t('app.c2', 'Geo Marker Color'),
            'created_by' => Yii::t('app.c2', 'Created By'),
            'updated_by' => Yii::t('app.c2', 'Updated By'),
            'status' => Yii::t('app.c2', 'Status'),
            'position' => Yii::t('app.c2', 'Position'),
            'created_at' => Yii::t('app.c2', 'Created At'),
            'updated_at' => Yii::t('app.c2', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\c2\query\ChessQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\c2\query\ChessQuery(get_called_class());
    }
    
    /**
    * setup default values
    **/
    public function loadDefaultValues($skipIfSet = true) {
        parent::loadDefaultValues($skipIfSet);
    }

}
