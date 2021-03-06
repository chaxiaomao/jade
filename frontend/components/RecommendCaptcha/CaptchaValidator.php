<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/8
 * Time: 12:55
 */

namespace frontend\components\RecommendCaptcha;


use common\models\c2\entity\FeUserAuthModel;
use common\models\c2\entity\RecommendCodeModel;
use common\models\c2\entity\UserRecommendCodeModel;
use Yii;
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
        $model = UserRecommendCodeModel::findOne(['code' => $value]);
        if ($model) {
            if (strtotime($model->expired_at) > strtotime(date('Y-m-d H:i:s')) || $value == "") {
                return [];
            }
        }
        return [Yii::t('app.c2', 'The Recommend code is incorrect.'), []];
    }
}