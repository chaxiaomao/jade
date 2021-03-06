<?php

namespace common\models\c2\entity;

use Yii;

/**
 * This is the model class for table "{{%elder_chieftain_rs}}".
 *
 * @property string $id
 * @property string $elder_id
 * @property string $chieftain_id
 * @property integer $status
 * @property integer $position
 * @property string $created_at
 * @property string $updated_at
 */
class ElderChieftainRsModel extends \cza\base\models\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%elder_chieftain_rs}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['elder_id', 'chieftain_id', 'position'], 'integer'],
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
            'elder_id' => Yii::t('app.c2', 'Elder ID'),
            'chieftain_id' => Yii::t('app.c2', 'Chieftain ID'),
            'status' => Yii::t('app.c2', 'Status'),
            'position' => Yii::t('app.c2', 'Position'),
            'created_at' => Yii::t('app.c2', 'Created At'),
            'updated_at' => Yii::t('app.c2', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\c2\query\ElderChieftainRsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\c2\query\ElderChieftainRsQuery(get_called_class());
    }
    
    /**
    * setup default values
    **/
    public function loadDefaultValues($skipIfSet = true) {
        parent::loadDefaultValues($skipIfSet);
    }

}
