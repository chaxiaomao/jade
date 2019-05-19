<?php

namespace common\models\c2\entity;

use backend\models\c2\entity\rbac\BeUser;
use common\helpers\CodeGenerator;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%grp}}".
 *
 * @property string $id
 * @property integer $type
 * @property string $attributeset_id
 * @property string $province_id
 * @property string $city_id
 * @property string $district_id
 * @property string $code
 * @property string $label
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
class GRPModel extends \cza\base\models\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%grp}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['attributeset_id', 'province_id', 'city_id', 'district_id', 'created_by', 'updated_by', 'position'], 'integer'],
            [['label'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['type', 'status'], 'integer', 'max' => 4],
            [['code', 'label', 'geo_longitude', 'geo_latitude', 'geo_marker_color'], 'string', 'max' => 255],
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
            'attributeset_id' => Yii::t('app.c2', 'Attributeset ID'),
            'province_id' => Yii::t('app.c2', 'Province'),
            'city_id' => Yii::t('app.c2', 'City'),
            'district_id' => Yii::t('app.c2', 'District'),
            'code' => Yii::t('app.c2', 'Code'),
            'label' => Yii::t('app.c2', 'Label'),
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
     * @return \common\models\c2\query\GRPQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\c2\query\GRPQuery(get_called_class());
    }
    
    /**
    * setup default values
    **/
    public function loadDefaultValues($skipIfSet = true) {
        parent::loadDefaultValues($skipIfSet);
        if ($this->isNewRecord) {
            $this->code = CodeGenerator::getCodeByDate($this, 'GRP');
        }
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
           BlameableBehavior::className()
        ]);
    }

    public function getCreator()
    {
        return $this->hasOne(BeUser::className(), ['id' => 'created_by']);
    }

    public function getUpdater()
    {
        return $this->hasOne(BeUser::className(), ['id' => 'updated_by']);
    }

}
