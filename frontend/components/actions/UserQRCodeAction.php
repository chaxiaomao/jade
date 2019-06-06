<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/6 0006
 * Time: 下午 15:46
 */

namespace frontend\components\actions;


use Yii;
use yii\base\Action;
use yii\base\InvalidConfigException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class UserQRCodeAction extends Action
{

    public function run() {
        try {
            $qr = Yii::$app->get('qr');
        } catch (InvalidConfigException $e) {
            new NotFoundHttpException($e->getMessage());
        }
        $grpSession = Yii::$app->session;
        if (is_null($grpSession->get('grp_id'))) {
            throw new NotFoundHttpException(Yii::t('app.c2', 'Params not allow.'));
        }

        Yii::$app->response->format = Response::FORMAT_RAW;
        Yii::$app->response->headers->add('Content-Type', $qr->getContentType());

        $user = Yii::$app->user->currentUser;
        $code = $user->getInviteCode($grpSession->get('grp_id'));

        return $qr
            // ->useLogo(Yii::getAlias('@frontend') . '/images/logo.jpg')
            // ->setLogoWidth(10)
            ->setText(FRONTEND_BASE_URL . '/user/signup?c=' . $code)
            ->setLabel(Yii::t('app.c2', 'My QRCode'))
            ->writeString();
    }
}