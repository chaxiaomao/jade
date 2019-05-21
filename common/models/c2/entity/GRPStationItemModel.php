<?php

namespace common\models\c2\entity;

use Yii;

/**
 * This is the model class for table "{{%grp_station_item}}".
 *
 * @property string $id
 * @property string $grp_station_id
 * @property string $user_id
 * @property string $label
 * @property integer $state
 * @property integer $status
 * @property integer $position
 * @property string $created_at
 * @property string $updated_at
 */
class GRPStationItemModel extends \cza\base\models\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%grp_station_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['grp_station_id', 'user_id', 'position'], 'integer'],
            [['grp_station_id', 'user_id'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['label'], 'string', 'max' => 255],
            [['state', 'status'], 'integer', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app.c2', 'ID'),
            'grp_station_id' => Yii::t('app.c2', 'Grp Station ID'),
            'user_id' => Yii::t('app.c2', 'User ID'),
            'label' => Yii::t('app.c2', 'Label'),
            'state' => Yii::t('app.c2', 'State'),
            'status' => Yii::t('app.c2', 'Status'),
            'position' => Yii::t('app.c2', 'Position'),
            'created_at' => Yii::t('app.c2', 'Created At'),
            'updated_at' => Yii::t('app.c2', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\c2\query\GRPStationItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\c2\query\GRPStationItemQuery(get_called_class());
    }
    
    /**
    * setup default values
    **/
    public function loadDefaultValues($skipIfSet = true) {
        parent::loadDefaultValues($skipIfSet);
    }

    public function getUser()
    {
        return $this->hasOne(FeUserModel::className(), ['id' => 'user_id']);
    }

}
