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

    public $css = [
        'css/bootstrap.css',
        'css/bootstrap-grid.css',
        'css/bootstrap-reboot.css',
        'css/main.css',
    ];
    public $js = [
        'js/bootstrap.bundle.js',
        'js/bootstrap.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        // 'yii\bootstrap\BootstrapAsset',
        // 'yii\bootstrap\BootstrapPluginAsset',

    ];
    public $publishOptions = [
        'forceCopy' => YII_DEBUG,
    ];

    public function init()
    {
        $this->sourcePath = '@app/themes/' . CZA_FRONTEND_THEME . '/assets';
        parent::init();
    }

    public $jsOptions=[
        'position'=>\yii\web\View::POS_HEAD,
    ];

}
