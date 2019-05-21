<?php

namespace common\models\c2\entity;

use Yii;

/**
 * This is the model class for table "{{%familiar_peasant_rs}}".
 *
 * @property string $id
 * @property string $chess_id
 * @property string $familiar_id
 * @property string $peasant_id
 * @property integer $status
 * @property integer $position
 * @property string $created_at
 * @property string $updated_at
 */
class FamiliarPeasantRsModel extends \cza\base\models\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%familiar_peasant_rs}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['chess_id', 'familiar_id', 'peasant_id', 'position'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['status'], 'integer', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app.c2', 'ID'),
            'chess_id' => Yii::t('app.c2', 'Chess ID'),
            'familiar_id' => Yii::t('app.c2', 'Familiar ID'),
            'peasant_id' => Yii::t('app.c2', 'Peasant ID'),
            'status' => Yii::t('app.c2', 'Status'),
            'position' => Yii::t('app.c2', 'Position'),
            'created_at' => Yii::t('app.c2', 'Created At'),
            'updated_at' => Yii::t('app.c2', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\c2\query\FamiliarPeasantRsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\c2\query\FamiliarPeasantRsQuery(get_called_class());
    }
    
    /**
    * setup default values
    **/
    public function loadDefaultValues($skipIfSet = true) {
        parent::loadDefaultValues($skipIfSet);
    }

    public function getUser()
    {
        return $this->hasOne(FeUserModel::className(), ['id' => 'peasant_id']);
    }

}
