<?php

namespace common\models\c2\entity;

use common\components\validators\FeUserUniqueValidator;
use common\helpers\DeviceLogHelper;
use common\models\c2\statics\FeUserType;
use cza\base\models\statics\EntityModelStatus;
use Yii;
use yii\base\Object;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "{{%fe_user}}".
 *
 * @property string $id
 * @property integer $type
 * @property string $attributeset_id
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property string $auth_key
 * @property string $confirmed_at
 * @property string $unconfirmed_email
 * @property string $blocked_at
 * @property string $registration_ip
 * @property integer $registration_src_type
 * @property integer $flags
 * @property integer $level
 * @property string $last_login_at
 * @property string $last_login_ip
 * @property string $open_id
 * @property string $wechat_union_id
 * @property string $wechat_open_id
 * @property string $mobile_number
 * @property string $sms_receipt
 * @property string $access_token
 * @property string $password_reset_token
 * @property string $province_id
 * @property string $city_id
 * @property string $created_by
 * @property string $updated_by
 * @property integer $status
 * @property integer $position
 * @property string $created_at
 * @property string $updated_at
 * @property string $district_id
 */
class FeUserModel extends \cza\base\models\ActiveRecord implements IdentityInterface
{
    // use \common\traits\AttachmentTrait;

    /** @var string Plain password. Used for model validation. */
    public $password;
    /**
     * @var UserChessRsModel
     */
    public $currentChess = null;
    public $recommendUserId = null;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%fe_user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // [['attributeset_id', 'flags', 'province_id', 'city_id', 'created_by', 'updated_by', 'position'], 'integer'],
            // [['username'], 'required'],
            // [['confirmed_at', 'blocked_at', 'last_login_at', 'created_at', 'updated_at'], 'safe'],
            // [['type', 'registration_src_type', 'level', 'status'], 'string', 'max' => 4],
            // [['username', 'email', 'password_hash', 'auth_key', 'unconfirmed_email', 'registration_ip', 'last_login_ip', 'open_id', 'wechat_open_id', 'mobile_number', 'sms_receipt', 'access_token', 'password_reset_token'], 'string', 'max' => 255],
            // [['wechat_union_id'], 'string', 'max' => 10],
            [['registration_src_type', 'type', 'attributeset_id', 'flags', 'created_by', 'updated_by', 'status', 'position', 'province_id', 'city_id', 'district_id'], 'integer'],
            [['username'], 'required'],
            [['email'], 'email'],
            [['wechat_open_id', 'username', 'mobile_number', 'email'], FeUserUniqueValidator::className(), 'targetClass' => FeUserModel::className(), 'message' => Yii::t('app.c2', '{attribute} "{value}" has already been taken.')],
            [['confirmed_at', 'blocked_at', 'last_login_at', 'created_at', 'updated_at'], 'safe'],
            [['username', 'email', 'password_hash', 'auth_key', 'unconfirmed_email', 'registration_ip', 'last_login_ip', 'open_id', 'wechat_union_id', 'wechat_open_id', 'mobile_number', 'access_token'], 'string', 'max' => 255],
            'passwordRequired' => ['password', 'required', 'on' => ['register']],
            'passwordLength' => ['password', 'string', 'min' => 6, 'max' => 72,],
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
            'username' => Yii::t('app.c2', 'Username'),
            'email' => Yii::t('app.c2', 'Email'),
            'password_hash' => Yii::t('app.c2', 'Password Hash'),
            'auth_key' => Yii::t('app.c2', 'Auth Key'),
            'confirmed_at' => Yii::t('app.c2', 'Confirmed At'),
            'unconfirmed_email' => Yii::t('app.c2', 'Unconfirmed Email'),
            'blocked_at' => Yii::t('app.c2', 'Blocked At'),
            'registration_ip' => Yii::t('app.c2', 'Registration Ip'),
            'registration_src_type' => Yii::t('app.c2', 'Registration Src Type'),
            'flags' => Yii::t('app.c2', 'Flags'),
            'level' => Yii::t('app.c2', 'Level'),
            'last_login_at' => Yii::t('app.c2', 'Last Login At'),
            'last_login_ip' => Yii::t('app.c2', 'Last Login Ip'),
            'open_id' => Yii::t('app.c2', 'Open ID'),
            'wechat_union_id' => Yii::t('app.c2', 'Wechat Union ID'),
            'wechat_open_id' => Yii::t('app.c2', 'Wechat Open ID'),
            'mobile_number' => Yii::t('app.c2', 'Mobile Number'),
            'sms_receipt' => Yii::t('app.c2', 'Sms Receipt'),
            'access_token' => Yii::t('app.c2', 'Access Token'),
            'password_reset_token' => Yii::t('app.c2', 'Password Reset Token'),
            'province_id' => Yii::t('app.c2', 'Province ID'),
            'city_id' => Yii::t('app.c2', 'City ID'),
            'district_id' => Yii::t('app.c2', 'District ID'),
            'created_by' => Yii::t('app.c2', 'Created By'),
            'updated_by' => Yii::t('app.c2', 'Updated By'),
            'status' => Yii::t('app.c2', 'Status'),
            'position' => Yii::t('app.c2', 'Position'),
            'created_at' => Yii::t('app.c2', 'Created At'),
            'updated_at' => Yii::t('app.c2', 'Updated At'),
            'password' => Yii::t('app.c2', 'Password'),
            'degree_id' => Yii::t('app.c2', 'Degree'),
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\c2\query\FeUserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\c2\query\FeUserQuery(get_called_class());
    }

    /**
     * setup default values
     **/
    public function loadDefaultValues($skipIfSet = true)
    {
        parent::loadDefaultValues($skipIfSet);
        // $this->type = FeUserType::TYPE_PEASANT;
    }

    /**
     * Finds an identity by the given ID.
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     * @throws NotFoundHttpException
     */
    public static function findIdentity($id)
    {
        // TODO: Implement findIdentity() method.
        return static::findOne(['id' => $id, 'status' => EntityModelStatus::STATUS_ACTIVE]);
        // return static::getTerminalUser($identity);
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
        $identity = static::findOne(['access_token' => $token, 'status' => EntityModelStatus::STATUS_ACTIVE]);
        return static::getTerminalUser($identity);
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|int an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        // TODO: Implement getId() method.
        return $this->getPrimaryKey();
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
        return $this->auth_key;
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return bool whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
        return $this->getAuthKey() === $authKey;
    }

    public static function getTerminalUser($identity = null)
    {
        if (!is_null($identity)) {
            $id = $identity->id;
            switch ($identity->type):
                case FeUserType::TYPE_LORD:
                    $model = LordModel::findOne(['id' => $id, 'status' => EntityModelStatus::STATUS_ACTIVE]);
                    break;
                case FeUserType::TYPE_ELDER:
                    $model = ElderModel::findOne(['id' => $id, 'status' => EntityModelStatus::STATUS_ACTIVE]);
                    break;
                case FeUserType::TYPE_CHIEFTAIN:
                    $model = ChieftainModel::findOne(['id' => $id, 'status' => EntityModelStatus::STATUS_ACTIVE]);
                    break;
                case FeUserType::TYPE_MASTER:
                    $model = MasterModel::findOne(['id' => $id, 'status' => EntityModelStatus::STATUS_ACTIVE]);
                    break;
                case FeUserType::TYPE_FAMILIAR:
                    $model = FamiliarModel::findOne(['id' => $id, 'status' => EntityModelStatus::STATUS_ACTIVE]);
                    break;
                case FeUserType::TYPE_PEASANT:
                    $model = PeasantModel::findOne(['id' => $id, 'status' => EntityModelStatus::STATUS_ACTIVE]);
                    break;
                default:
                    $model = FeUserModel::findOne(['id' => $id, 'status' => EntityModelStatus::STATUS_ACTIVE]);
            endswitch;
            return $model;
        }
        return null;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if ($insert) {
            $this->updateAttributes([
                'registration_src_type' => DeviceLogHelper::getDeviceType()
            ]);
        } else {
            if (isset($changedAttributes['province_id']) || isset($changedAttributes['city_id']) || isset($changedAttributes['district_id'])) {
                $this->profile->syncRegionData();
            }
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        $modelClass = $this->getProfileModelClass();
        return $this->hasOne($modelClass::className(), ['user_id' => 'id']);
    }

    /**
     * @return Object
     */
    public function getProfileModelClass()
    {
        if (is_null($this->type)) {
            $this->type = FeUserType::TYPE_DEFAULT;
        }
        return FeUserType::getModelClass($this->type);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => EntityModelStatus::STATUS_ACTIVE]);
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public static function findByMobileNumber($mobile)
    {
        return static::findOne(['mobile_number' => $mobile, 'status' => EntityModelStatus::STATUS_ACTIVE]);
    }

    public function getUserChessRs()
    {
        return $this->hasMany(UserChessRsModel::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecommendCode()
    {
        return $this->hasOne(UserRecommendCodeModel::className(), ['user_id' => 'id']);
    }

    public function getRecommendCode8ChessId($chess_id = '')
    {
        return $this->getRecommendCode()->where(['chess_id' => $chess_id])->one();
    }

    /**
     * @return array|UserChessRsModel|null
     * @throws NotFoundHttpException
     */
    public function getCurrentChess()
    {
        $current_chess_id = Yii::$app->session->get('current_chess_id');
        $model = null;
        if (empty($current_chess_id)) {
            $model = UserChessRsModel::find()->where(['user_id' => $this->id])->orderBy(['created_at' => SORT_ASC])->one();
        } else {
            $model = UserChessRsModel::find()->where(['chess_id' => $current_chess_id, 'user_id' => $this->id])->one();
        }
        if (!empty($model)) {
            Yii::$app->session->set('current_chess_id', $model->chess_id);
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app.c2', 'Chess not in'));
        }
    }

    public function getDevelopments()
    {
        try {
            return $this->getCurrentChess()->getUserDevelopments()
                ->where(['status' => EntityModelStatus::STATUS_ACTIVE])
                ->all();
        } catch (NotFoundHttpException $e) {
        }
    }

    public function getChess()
    {
        return $this->hasMany(ChessModel::className(), ['id' => 'chess_id'])
            ->viaTable('{{%user_chess_rs}}', ['user_id' => 'id']);
    }

    public function createRelations()
    {
        if ($this->currentChess->getChessChieftain()->count() == 0) {
            return $this->createChessChieftain();
        } elseif ($this->currentChess->getChessMasters()->count() <= 3) {
            return $this->createChessChieftainMaserRs();
        }

        $familiarCount = $this->currentChess->getFamiliars()->count();
        if ($familiarCount <= 9) {
            return $this->createChessMasterFamiliarRs($familiarCount);
        }

        $peasantCount = $this->currentChess->getPeasants()->count();
        if ($peasantCount <= 27) {
            return $this->createChessFamiliarPeasantRs($peasantCount);
        }
    }

    public function createDevelopment()
    {
        $model = new UserDevelopmentModel();
        $model->setAttributes([
            'chess_id' => $this->currentChess->id,
            'user_id' => $this->id,
            'parent_id' => $this->recommendUserId,
        ]);
        if ($model->save()) {
            return true;
        }
    }

    /**
     * Create chess chieftain.
     * @return bool
     */
    public function createChessChieftain()
    {
        $model = new UserChessRsModel();
        $attrs = [
            'user_id' => $this->id,
            'chess_id' => $this->currentChess->id,
            'type' => FeUserType::TYPE_CHIEFTAIN,
        ];
        $model->setAttributes($attrs);
        if ($model->save()) {
            return true;
        }
    }

    /**
     * Create chess master, user below to this chess's C1.
     * @return bool
     */
    public function createChessChieftainMaserRs()
    {
        $model = new UserChessRsModel();
        $attrs = [
            'user_id' => $this->id,
            'chess_id' => $this->currentChess->id,
            'type' => FeUserType::TYPE_MASTER,
        ];
        $model->setAttributes($attrs);
        $model->save();
        // This chess chieftain
        $chieftain = $this->currentChess->getChessChieftain(); // Only one.
        $rsModel = new ChieftainMasterRsModel();
        $attrs = [
            'chess_id' => $this->currentChess->id,
            'chieftain_id' => $chieftain->id,
            'master_id' => $this->id,
        ];
        $rsModel->setAttributes($attrs);
        if ($model->save()) {
            return true;
        }
    }

    /**
     * Evil epoll
     * Create chess familiar and set the regular position.
     * @param $familiarCount
     * @return bool
     */
    public function createChessMasterFamiliarRs($familiarCount)
    {
        // This chess masters
        $masters = $this->currentChess->getChessChieftain()->all();
        $masterIds = ArrayHelper::getColumn($masters, 'id');
        $currentUserIndex = $familiarCount + 1; // Current familiar user created index.
        $baseNum = 1;
        for ($i = 0; $i < 3; $i++) {
            for ($j = 0; $j < 3; $j++) {
                if ($currentUserIndex == $baseNum + $j * 3) {
                    $rsModel = new MasterFamiliarRsModel();
                    $attrs = [
                        'chess_id' => $this->currentChess->id,
                        'master_id' => $masterIds[$i],
                        'familiar_id' => $this->id,
                    ];
                    $rsModel->setAttributes($attrs);
                    if ($rsModel->save()) {
                        return true;
                        break;
                    }
                }
            }
            $baseNum++;
        }
    }

    /**
     * Evil epoll
     * Create chess peasant and set the regular position.
     * @param $peasantCount
     * @return bool
     */
    public function createChessFamiliarPeasantRs($peasantCount)
    {
        // This chess familiars.
        $familiars = $this->currentChess->getFamiliars()->all();
        $masterIds = ArrayHelper::getColumn($familiars, 'id');
        $currentUserIndex = $peasantCount + 1; // Current peasant user created index.
        $baseNum = 1;
        for ($i = 0; $i < 9; $i++) {
            for ($j = 0; $j < 3; $j++) {
                if ($currentUserIndex == $baseNum + $j * 8) {
                    $rsModel = new FamiliarPeasantRsModel();
                    $attrs = [
                        'chess_id' => $this->currentChess->id,
                        'familiar_id' => $masterIds[$i],
                        'peasant_id' => $this->id,
                    ];
                    $rsModel->setAttributes($attrs);
                    if ($rsModel->save()) {
                        return true;
                        break;
                    }
                }
            }
            $baseNum++;
        }
    }

}
