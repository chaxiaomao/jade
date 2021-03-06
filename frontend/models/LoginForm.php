<?php
namespace frontend\models;

use common\models\c2\entity\FeUserModel;
use cza\base\models\ModelTrait;
use dektrium\user\Finder;
use dektrium\user\traits\ModuleTrait;
use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    // use ModuleTrait;
    use ModelTrait;
    public $mobile_number;
    public $password;
    public $rememberMe = true;

    private $_user = false;

    // /** @var Finder */
    // protected $finder;
    //
    // /**
    //  * @param Finder $finder
    //  * @param array  $config
    //  */
    // public function __construct(Finder $finder, $config = []) {
    //     $this->finder = $finder;
    //     parent::__construct($config);
    // }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['mobile_number', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, Yii::t('app.c2', 'Incorrect username or password.'));
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'mobile_number' => Yii::t('app.c2', 'Mobile Number'),
            'password'=> Yii::t('app.c2', 'Password'),
            'verifyCode' => Yii::t('app.c2', 'Verification Code'),
            'recommendCode' => Yii::t('app.c2', 'Recommend Code'),
        ];
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            Yii::$app->user->on(\frontend\components\User::EVENT_AFTER_LOGIN, function($event) {
                $user = $event->identity;
                $user->last_login_at = date("Y-m-d H:i:s");
                $user->last_login_ip = Yii::$app->getRequest()->getUserIP();
                $user->update(false);
            });
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return FeUserModel|null
     */
    // protected function getUser()
    // {
    //     if ($this->_user === null) {
    //         $this->_user = FeUserModel::findByUsername($this->username);
    //     }
    //
    //     return $this->_user;
    // }

    /**
     * Finds user by [[mobile]]
     *
     * @return FeUserModel|null
     */
    protected function getUser() {
        if ($this->_user === false) {
            $this->_user = FeUserModel::findByMobileNumber($this->mobile_number);
        }
        return $this->_user;
    }

}
