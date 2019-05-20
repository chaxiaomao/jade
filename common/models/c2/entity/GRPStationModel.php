<?php

namespace common\models\c2\entity;

use Yii;

/**
 * This is the model class for table "{{%grp_station}}".
 *
 * @property string $id
 * @property string $grp_id
 * @property integer $type
 * @property string $name
 * @property string $label
 * @property string $parent_station_id
 * @property integer $status
 * @property integer $position
 * @property string $created_at
 * @property string $updated_at
 */
class GRPStationModel extends \cza\base\models\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%grp_station}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['grp_id', 'parent_station_id', 'position'], 'integer'],
            [['grp_id', 'label'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['type', 'status'], 'integer', 'max' => 4],
            [['name', 'label'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app.c2', 'ID'),
            'grp_id' => Yii::t('app.c2', 'Grp ID'),
            'type' => Yii::t('app.c2', 'Type'),
            'name' => Yii::t('app.c2', 'Name'),
            'label' => Yii::t('app.c2', 'Label'),
            'parent_station_id' => Yii::t('app.c2', 'Parent Station ID'),
            'status' => Yii::t('app.c2', 'Status'),
            'position' => Yii::t('app.c2', 'Position'),
            'created_at' => Yii::t('app.c2', 'Created At'),
            'updated_at' => Yii::t('app.c2', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\c2\query\GRPStationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\c2\query\GRPStationQuery(get_called_class());
    }
    
    /**
    * setup default values
    **/
    public function loadDefaultValues($skipIfSet = true) {
        parent::loadDefaultValues($skipIfSet);
    }

    public function getGRP()
    {
        return $this->hasOne(GRPModel::className(), ['id' => 'grp_id']);
    }

    public function getGRPStationItems()
    {
        return $this->hasMany(GRPStationItemModel::className(), ['grp_station_id' => 'id']);
    }

    public function getGRPStationParent()
    {
        return $this->hasMany(GRPStationModel::className(), ['id' => 'parent_station_id']);
    }

    public function getGRPStationChildren()
    {
        return $this->hasMany(GRPStationModel::className(), ['parent_station_id' => 'id']);
    }

}
