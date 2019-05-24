<?php

namespace common\models\c2\entity;

use Yii;

/**
 * This is the model class for table "{{%user_invite_code}}".
 *
 * @property integer $id
 * @property integer $grp_id
 * @property integer $user_id
 * @property string $code
 * @property string $expired_at
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class UserInviteCodeModel extends \cza\base\models\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_invite_code}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['grp_id', 'user_id'], 'integer'],
            [['code'], 'string'],
            [['created_at', 'updated_at', 'expired_at'], 'safe'],
            [['code'], 'string', 'max' => 255],
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
            'grp_id' => Yii::t('app.c2', 'Grp ID'),
            'user_id' => Yii::t('app.c2', 'User ID'),
            'code' => Yii::t('app.c2', 'Code'),
            'expired_at' => Yii::t('app.c2', 'Expired At'),
            'status' => Yii::t('app.c2', 'Status'),
            'created_at' => Yii::t('app.c2', 'Created At'),
            'updated_at' => Yii::t('app.c2', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\c2\query\UserInviteCodeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\c2\query\UserInviteCodeQuery(get_called_class());
    }
    
    /**
    * setup default values
    **/
    public function loadDefaultValues($skipIfSet = true) {
        parent::loadDefaultValues($skipIfSet);
    }

}
