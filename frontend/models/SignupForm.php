<?php

namespace frontend\models;

use common\components\SmsCaptcha\CaptchaValidator;
use common\models\c2\entity\ChieftainModel;
use common\models\c2\entity\ElderModel;
use common\models\c2\entity\FamiliarModel;
use common\models\c2\entity\FeUserAuthModel;
use common\models\c2\entity\FeUserModel;
use common\models\c2\entity\LordElderRsModel;
use common\models\c2\entity\MasterModel;
use common\models\c2\entity\PeasantModel;
use common\models\c2\entity\UserDegreeModel;
use common\models\c2\statics\FeUserType;
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
    public $password;
    public $verifyCode;
    public $recommendCode;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\c2\entity\FeUserModel', 'message' => 'This username has already been taken.'],
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
            'verifyCode' => Yii::t('app.c2', 'Verification Code'),
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

        $model = FeUserAuthModel::findOne(['source' => $this->recommendCode]);
        $type = FeUserType::TYPE_PEASANT;
        if (!is_null($model)) {
            $type = $model->type;
        }
        switch ($type):
            case FeUserType::TYPE_LORD:
                $user = new ElderModel();
                $user->lordId = $model->user_id;
                $user->degree_id = UserDegreeModel::findOne(['type' => FeUserType::TYPE_ELDER])->id;
                $user->type = FeUserType::TYPE_ELDER;
                break;
            case FeUserType::TYPE_ELDER:
                $user = new ChieftainModel();
                $user->elderId = $model->user_id;
                $user->degree_id = UserDegreeModel::findOne(['type' => FeUserType::TYPE_CHIEFTAIN])->id;
                $user->type = FeUserType::TYPE_CHIEFTAIN;
                break;
            case FeUserType::TYPE_CHIEFTAIN:
                $user = new MasterModel();
                $user->chieftainId = $model->user_id;
                $user->degree_id = UserDegreeModel::findOne(['type' => FeUserType::TYPE_MASTER])->id;
                $user->type = FeUserType::TYPE_MASTER;
                break;
            case FeUserType::TYPE_MASTER:
                $user = new FamiliarModel();
                $user->masterId = $model->user_id;
                $user->degree_id = UserDegreeModel::findOne(['type' => FeUserType::TYPE_FAMILIAR])->id;
                $user->type = FeUserType::TYPE_FAMILIAR;
                break;
            case FeUserType::TYPE_FAMILIAR:
                $user = new PeasantModel();
                $user->familiarId = $model->user_id;
                $user->degree_id = UserDegreeModel::findOne(['type' => FeUserType::TYPE_PEASANT])->id;
                $user->type = FeUserType::TYPE_PEASANT;
                break;
            default:
                $user = new FeUserModel();
                $user->degree_id = UserDegreeModel::findOne(['type' => FeUserType::TYPE_PEASANT])->id;
                $user->type = FeUserType::TYPE_PEASANT;
        endswitch;
        $user->username = $this->username;
        $user->mobile_number = $this->mobile_number;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        return $user->save() ? $user : Yii::info($user->errors);
    }

}
