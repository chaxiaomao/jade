<?php

namespace common\models\c2\entity;

use Yii;

/**
 * This is the model class for table "{{%grp_branch}}".
 *
 * @property string $id
 * @property string $grp_id
 * @property string $children_id
 * @property string $parent_id
 * @property integer $type
 * @property integer $state
 * @property integer $status
 * @property integer $position
 * @property string $created_at
 * @property string $updated_at
 */
class GRPBranchModel extends \cza\base\models\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%grp_branch}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['grp_id', 'children_id', 'parent_id', 'position'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['type', 'state', 'status'], 'integer', 'max' => 4],
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
            'parent_id' => Yii::t('app.c2', 'Parent ID'),
            'type' => Yii::t('app.c2', 'Type'),
            'state' => Yii::t('app.c2', 'State'),
            'status' => Yii::t('app.c2', 'Status'),
            'position' => Yii::t('app.c2', 'Position'),
            'created_at' => Yii::t('app.c2', 'Created At'),
            'updated_at' => Yii::t('app.c2', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\c2\query\GrpBranchQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\c2\query\GrpBranchQuery(get_called_class());
    }
    
    /**
    * setup default values
    **/
    public function loadDefaultValues($skipIfSet = true) {
        parent::loadDefaultValues($skipIfSet);
    }

    public function getParentGRP()
    {
        return $this->hasOne(GRPModel::className(), ['id' => 'parent_id']);
    }

    public function getChildrenGRP()
    {
        return $this->hasOne(GRPModel::className(), ['id' => 'children_id']);
    }

    public function getGRP()
    {
        return $this->hasOne(GRPModel::className(), ['id' => 'grp_id']);
    }

}
