<?php

/**
 * 
 * 
 * @author Ben Bi <ben@cciza.com>
 * @link http://www.cciza.com/
 * @copyright 2014-2016 CCIZA Software LLC
 * @license
 */

namespace common\assets\JqueryWeui;

use yii\web\AssetBundle;

/**
 * @author Ben Bi <jianbinbi@gmail.com>
 * @since 2.0
 */
class JqueryWeuiAsset extends AssetBundle {

    public $sourcePath = '@common/assets/JqueryWeui/src';
    public $publishOptions = [
        'forceCopy' => YII_DEBUG,
    ];
    public $css = [
        'lib/weui.min.css',
        'css/jquery-weui.min.css',
    ];
    public $js = [
        'js/jquery-weui.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];

}
