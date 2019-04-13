<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\components\SmsCaptcha;

use common\helpers\Helpers;
use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\widgets\InputWidget;

/**
 * Captcha renders a CAPTCHA image and an input field that takes user-entered verification code.
 *
 * Captcha is used together with [[CaptchaAction]] to provide [CAPTCHA](http://en.wikipedia.org/wiki/Captcha) - a way
 * of preventing website spamming.
 *
 * The image element rendered by Captcha will display a CAPTCHA image generated by
 * an action whose route is specified by [[captchaAction]]. This action must be an instance of [[CaptchaAction]].
 *
 * When the user clicks on the CAPTCHA image, it will cause the CAPTCHA image
 * to be refreshed with a new CAPTCHA.
 *
 * You may use [[\yii\captcha\CaptchaValidator]] to validate the user input matches
 * the current CAPTCHA verification code.
 *
 * The following example shows how to use this widget with a model attribute:
 *
 * ```php
 * echo Captcha::widget([
 *     'model' => $model,
 *     'attribute' => 'captcha',
 * ]);
 * ```
 *
 * The following example will use the name property instead:
 *
 * ```php
 * echo Captcha::widget([
 *     'name' => 'captcha',
 * ]);
 * ```
 *
 * You can also use this widget in an [[\yii\widgets\ActiveForm|ActiveForm]] using the [[\yii\widgets\ActiveField::widget()|widget()]]
 * method, for example like this:
 *
 * ```php
 * <?= $form->field($model, 'captcha')->widget(\yii\captcha\Captcha::classname(), [
 *     // configure additional widget properties here
 * ]) ?>
 * ```
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class Captcha extends InputWidget {

    /**
     * @var string|array the route of the action that generates the CAPTCHA images.
     * The action represented by this route must be an action of [[CaptchaAction]].
     * Please refer to [[\yii\helpers\Url::toRoute()]] for acceptable formats.
     */
    public $captchaAction = 'register/sms-captcha';

    /**
     * mobile number attribute
     * @var type
     */
    public $mobileId;
    public $delaySeconds = 6;

    /**
     * @var array HTML attributes to be applied to the CAPTCHA image tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $buttonOptions = ['class' => 'btn btn-success btn-lg', 'style' => 'height:100%;'];

    /**
     * @var string the template for arranging the CAPTCHA image tag and the text input tag.
     * In this template, the token `{image}` will be replaced with the actual image tag,
     * while `{input}` will be replaced with the text input tag.
     */
    // public $template = '<div class="input-group">{input}<div class="mf10">{button}</div></div>';
    public $template = '<div class="input-group">{input}<div class="mf10">{button}</div></div>';

    /**
     * @var array the HTML attributes for the input tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = ['class' => 'form-control form-control-lg'];
    public $form;

    /**
     * Initializes the widget.
     */
    public function init() {
        parent::init();
        static::checkRequirements();

        if (!isset($this->buttonOptions['id'])) {
            $this->buttonOptions['id'] = $this->options['id'] . '-button';
        }
    }

    /**
     * Renders the widget.
     */
    public function run() {
        $this->registerClientScript();
        $this->options['placeholder'] = Yii::t('app.c2', 'Verification Code');
        $this->options[] = ['type' => 'number'];
        if ($this->hasModel()) {
            $input = Html::activeTextInput($this->model, $this->attribute, $this->options);
        } else {
            $input = Html::textInput($this->name, $this->value, $this->options);
        }
        $input = str_replace('text', 'number', $input);
        $route = $this->captchaAction;
        if (is_array($route)) {
            $route['v'] = uniqid();
        } else {
            $route = [$route, 'v' => uniqid()];
        }
        $button = Html::button(Yii::t('app.c2', 'Retrive Sms Code'), $this->buttonOptions);
        echo strtr($this->template, [
            '{input}' => $input,
            '{button}' => $button,
        ]);
    }

    /**
     * Registers the needed JavaScript.
     */
    public function registerClientScript() {
        $id = $this->buttonOptions['id'];
        $view = $this->getView();

        $js = "";
        $js .= $this->getCookieFuncJs();


        $js .= "var countdown;
                function settime(obj) {
                    countdown=getCookieValue('secondsremained_login') ? getCookieValue('secondsremained_login') : 0;
                    if (countdown ==0) {
                        obj.removeAttr('disabled');
                        obj.text('" . Yii::t('app.c2', 'Retrive Sms Code') . "');
                        return;
                    } else {
                        obj.attr('disabled', true);
                        obj.text(countdown + '" . Yii::t('app.c2', 'seconds resend') . "');
                        countdown--;
                        editCookie('secondsremained_login',countdown,countdown+1);
                    }
                    setTimeout(function() { settime(obj) },1000) //1 second
                }
                    settime($('#{$id}'));
                ";
        $js .= "\n";

        $js .= "$('#{$id}').on('click', function(e) {
                   e.preventDefault();
//                   var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/; 
//                   if($('#{$this->mobileId}').val() == ''){
//                       bootbox.alert('" . Yii::t('app.c2', "Mobile number is required!") . "');
//                       return false;
//                   }else if(!myreg.test($('#{$this->mobileId}').val())){
//                       bootbox.alert('" . Yii::t('app.c2', "Mobile number must be right!") . "');
//                       return false;
//                   }
                   
                   addCookie('secondsremained_login'," . $this->delaySeconds . ", " . $this->delaySeconds . ");//valid time 60s
                   settime($('#{$id}'));
                   var vForm = jQuery('#" . $this->form->options['id'] . "');
                   var data = {mobile: $('#{$this->mobileId}').val()};
                   $.ajax({
                            url: '" . Url::toRoute($this->captchaAction) . "',
                            type: 'post',
                            data: data,
                            success: function(data) {
//                              bootbox.alert(data._meta.message);
                            },
                            error :function(data){alert(data._meta.message);}
                    });
                    return false;
                });";
        $js .= "\n";
        $view->registerJs($js);
    }

    /**
     *  cookie function
     */
    public function getCookieFuncJs() {
        $js = "";
        $js .= "function addCookie(name,value,expiresHours){
            var cookieString=name+'='+escape(value);
            if(expiresHours>0){
                var date=new Date();
                date.setTime(date.getTime()+expiresHours*1000);
                cookieString=cookieString+';expires=' + date.toUTCString();
            }
            document.cookie=cookieString;
        }";
        $js .= "\n";

        $js .= "function editCookie(name,value,expiresHours){
            var cookieString=name+'='+escape(value);
            if(expiresHours>0){
                var date=new Date();
                date.setTime(date.getTime()+expiresHours*1000);
                cookieString=cookieString+';expires=' + date.toGMTString();
            }
            document.cookie=cookieString;
        }";
        $js .= "\n";

        $js .= "function getCookieValue(name){
            var strCookie=document.cookie;
            var arrCookie=strCookie.split('; ');
            for(var i=0;i<arrCookie.length;i++){
                var arr=arrCookie[i].split('=');
                if(arr[0]==name){
                    return unescape(arr[1]);
                    break;
                }
            }
        }";
        $js .= "\n";

        return $js;
    }

    /**
     * Returns the options for the captcha JS widget.
     * @return array the options
     */
    //    protected function getClientOptions() {
    //        $route = $this->captchaAction;
    //        if (is_array($route)) {
    //            $route[CaptchaAction::REFRESH_GET_VAR] = 1;
    //        } else {
    //            $route = [$route, CaptchaAction::REFRESH_GET_VAR => 1];
    //        }
    //
    //        $options = [
    //            'refreshUrl' => Url::toRoute($route),
    //            'hashKey' => 'yiiCaptcha/' . trim($route[0], '/'),
    //        ];
    //
    //        return $options;
    //    }

    /**
     * Checks if there is graphic extension available to generate CAPTCHA images.
     * This method will check the existence of ImageMagick and GD extensions.
     * @return string the name of the graphic extension, either "imagick" or "gd".
     * @throws InvalidConfigException if neither ImageMagick nor GD is installed.
     */
    public static function checkRequirements() {
        if (!isset(Yii::$app->sms)) {
            throw new InvalidConfigException('Require Sms Component Support!');
        }
    }

}
