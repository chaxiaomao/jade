<?php

namespace frontend\models;

use common\components\SmsCaptcha\CaptchaValidator;
use common\components\validators\FeUserUniqueValidator;
use common\models\c2\entity\ChessModel;
use common\models\c2\entity\ChieftainModel;
use common\models\c2\entity\ElderModel;
use common\models\c2\entity\FamiliarModel;
use common\models\c2\entity\FeUserAuthModel;
use common\models\c2\entity\FeUserModel;
use common\models\c2\entity\LordElderRsModel;
use common\models\c2\entity\MasterModel;
use common\models\c2\entity\PeasantModel;
use common\models\c2\entity\RecommendCodeModel;
use common\models\c2\entity\UserDegreeModel;
use common\models\c2\entity\UserRecommendCodeModel;
use common\models\c2\statics\FeUserType;
use cza\base\models\ModelTrait;
use cza\base\models\statics\EntityModelStatus;
use frontent\models\AbstractRegisterForm;
use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    use ModelTrait;
    public $username;
    public $mobile_number;
    public $password;
    public $verifyCode;
    public $recommendCode;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\c2\entity\FeUserModel', 'message' => Yii::t('app.c2', 'This username has already been taken.')],
            ['username', 'string', 'min' => 2, 'max' => 255],

            [['password', 'mobile_number'], 'required'],
            [['mobile_number',], 'match', 'pattern' => '/^1[0-9]{10}$/', 'message' => Yii::t('app.c2', '{attribute} must be mobile format!')],
            [['mobile_number'], 'string', 'length' => 11],
            [['mobile_number'], 'number', 'integerOnly' => true],
            [['username', 'mobile_number'], 'unique', 'targetClass' => FeUserModel::className(), 'message' => Yii::t('app.c2', '{attribute} "{value}" has already been taken.')],
            // [['username', 'mobile_number'], FeUserUniqueValidator::className(), 'targetClass' => FeUserModel::className(), 'message' => Yii::t('app.c2', '{attribute} "{value}" has already been taken.')],

            // ['email', 'email'],
            // ['email', 'string', 'max' => 255],
            // ['email', 'unique', 'targetClass' => '\common\models\FeUserModel', 'message' => 'This email address has already been taken.'],
            ['password', 'string', 'min' => 6],
            ['verifyCode', CaptchaValidator::className()],

            ['recommendCode', 'trim'],
            ['recommendCode', \frontend\components\RecommendCaptcha\CaptchaValidator::className()],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mobile_number' => Yii::t('app.c2', 'Mobile Number'),
            'password' => Yii::t('app.c2', 'Password'),
            'verifyCode' => Yii::t('app.c2', 'Sms code'),
            'recommendCode' => Yii::t('app.c2', 'Recommend Code'),
            'username' => Yii::t('app.c2', 'Username'),
        ];
    }

    /**
     * Signs user up.
     *
     * @return FeUserModel|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        $user = new FeUserModel();
        $user->username = $this->username;
        $user->mobile_number = $this->mobile_number;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        return $user->save() && $user->createInviteUserKip($this->recommendCode) ? $user : null;
    }

}
