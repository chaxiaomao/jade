<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/8
 * Time: 12:55
 */

namespace frontend\components\RecommendCaptcha;


use common\models\c2\entity\FeUserAuthModel;
use common\models\c2\entity\FeUserModel;
use common\models\c2\entity\RecommendCodeModel;
use common\models\c2\entity\UserRecommendCodeModel;
use Yii;
use yii\base\InvalidConfigException;
use yii\validators\Validator;

class CaptchaValidator extends Validator
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if ($this->message === null) {
            $this->message = Yii::t('app.c2', 'The Recommend code is incorrect.');
        }
    }

    /**
     * @inheritdoc
     */
    protected function validateValue($value)
    {
        $model = FeUserModel::findOne(['mobile_number' => $value]);
        if (!is_null($model)) {
            return [];
        }
        return [Yii::t('app.c2', 'The Recommend code is incorrect.'), []];
    }
}