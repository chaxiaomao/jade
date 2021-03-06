<?php

namespace common\models\c2\entity;

use Yii;

/**
 * This is the model class for table "{{%master_familiar_rs}}".
 *
 * @property string $id
 * @property string $master_id
 * @property string $familiar_id
 * @property integer $status
 * @property integer $position
 * @property string $created_at
 * @property string $updated_at
 */
class MasterFamiliarRsModel extends \cza\base\models\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%master_familiar_rs}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['master_id', 'familiar_id', 'position'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['status'], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app.c2', 'ID'),
            'master_id' => Yii::t('app.c2', 'Master ID'),
            'familiar_id' => Yii::t('app.c2', 'Familiar ID'),
            'status' => Yii::t('app.c2', 'Status'),
            'position' => Yii::t('app.c2', 'Position'),
            'created_at' => Yii::t('app.c2', 'Created At'),
            'updated_at' => Yii::t('app.c2', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\c2\query\MasterFamiliarRsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\c2\query\MasterFamiliarRsQuery(get_called_class());
    }
    
    /**
    * setup default values
    **/
    public function loadDefaultValues($skipIfSet = true) {
        parent::loadDefaultValues($skipIfSet);
    }

}
