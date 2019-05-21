<?php

namespace common\models\c2\entity;

use common\models\c2\statics\FeUserType;
use Yii;

/**
 * This is the model class for table "{{%user_degree_rs}}".
 *
 * @property string $id
 * @property string $user_id
 * @property string $degree_id
 * @property integer $type
 * @property integer $status
 * @property integer $position
 * @property string $created_at
 * @property string $updated_at
 */
class UserDegreeRsModel extends \cza\base\models\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_degree_rs}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'degree_id', 'position', 'type'], 'integer'],
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
            'user_id' => Yii::t('app.c2', 'User ID'),
            'degree_id' => Yii::t('app.c2', 'Degree ID'),
            'type' => Yii::t('app.c2', 'Type'),
            'status' => Yii::t('app.c2', 'Status'),
            'position' => Yii::t('app.c2', 'Position'),
            'created_at' => Yii::t('app.c2', 'Created At'),
            'updated_at' => Yii::t('app.c2', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\c2\query\UserDegreeRsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\c2\query\UserDegreeRsQuery(get_called_class());
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

    public function getUserDegree()
    {
        return $this->hasOne(UserDegreeModel::className(), ['id' => 'degree_id']);
    }

    public function updateRs($type = FeUserType::TYPE_DEFAULT)
    {
        $model = UserDegreeModel::findOne(['type' => $type]);
        $this->updateAttributes([
           'type' => $type,
           'degree_id' => $model->id,
        ]);
        $this->save();
    }

}
