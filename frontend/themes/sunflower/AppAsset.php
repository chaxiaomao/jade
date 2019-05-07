<?php

namespace frontend\themes\sunflower;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    // public $basePath = '@webroot';
    // public $baseUrl = '@web';
    public $sourcePath = '@frontend/modules/sunflower/assets';

    public $css = [
        // 'mdui/css/mdui.css',
        // 'css/bootstrap.css',
        // 'css/bootstrap-grid.css',
        // 'css/bootstrap-reboot.css',
        'css/main.css',
        // 'css/jquery.mobile-1.4.5.min.css',
    ];
    public $js = [
        // 'mdui/js/mdui.js',
        // 'js/bootstrap.bundle.js',
        // 'js/bootstrap.js',
        'js/main.js',
        // 'js/jquery-1.11.3.min.js',
        // 'js/jquery.mobile-1.4.5.min.js',
        // 'js/jqm-tree.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',

    ];
    public $publishOptions = [
        'forceCopy' => YII_DEBUG,
    ];

    public function init()
    {
        $this->sourcePath = '@app/themes/' . CZA_FRONTEND_THEME . '/assets';
        parent::init();
    }

    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD,
    ];

}
