<?php

namespace common\models\c2\entity;

use Yii;

/**
 * This is the model class for table "{{%user_grp_rs}}".
 *
 * @property string $id
 * @property string $grp_id
 * @property string $user_id
 * @property integer $state
 * @property integer $status
 * @property integer $position
 * @property string $created_at
 * @property string $updated_at
 */
class UserGRPRsModel extends \cza\base\models\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_grp_rs}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['grp_id', 'user_id', 'position'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['state', 'status'], 'string', 'max' => 4],
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
            'user_id' => Yii::t('app.c2', 'User ID'),
            'state' => Yii::t('app.c2', 'State'),
            'status' => Yii::t('app.c2', 'Status'),
            'position' => Yii::t('app.c2', 'Position'),
            'created_at' => Yii::t('app.c2', 'Created At'),
            'updated_at' => Yii::t('app.c2', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\c2\query\UserGrpRsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\c2\query\UserGrpRsQuery(get_called_class());
    }
    
    /**
    * setup default values
    **/
    public function loadDefaultValues($skipIfSet = true) {
        parent::loadDefaultValues($skipIfSet);
    }

}
