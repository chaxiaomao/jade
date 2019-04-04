<?php
namespace frontend\models;

use common\components\SmsCaptcha\CaptchaValidator;
use common\models\c2\entity\FeUserModel;
use cza\base\models\ModelTrait;
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
    public $verifyCode;
    public $password;
    public $recommendCode;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\FeUserModel', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            [['password', 'mobile_number'], 'required'],
            [['mobile_number',], 'match', 'pattern' => '/^1[0-9]{10}$/', 'message' => Yii::t('app.c2', '{attribute} must be mobile format!')],
            [['mobile_number'], 'string', 'length' => 11],
            [['mobile_number'], 'number', 'integerOnly' => true],

            // ['email', 'email'],
            // ['email', 'string', 'max' => 255],
            // ['email', 'unique', 'targetClass' => '\common\models\FeUserModel', 'message' => 'This email address has already been taken.'],
            ['password', 'string', 'min' => 6],
            ['verifyCode', CaptchaValidator::className()],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'mobile_number' => Yii::t('app.c2', 'Mobile Number'),
            'password'=> Yii::t('app.c2', 'Password'),
            'verifyCode' => Yii::t('app.c2', 'Verification Code'),
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
        $user->mobile_number = $this->mobile_numbe;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }



}
