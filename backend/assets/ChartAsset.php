<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class ChartAsset extends AssetBundle
{
    // public $basePath = '@webroot';
    // public $baseUrl = '@web';
    public $css = [
        'css/font-awesome.min.css',
        'css/jquery.orgchart.css',
        'css/style.css',
    ];

    public $js = [
        'js/html2canvas.min.js',
        'js/jquery.orgchart.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    public $publishOptions = [
        'forceCopy' => YII_DEBUG,
    ];

    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];

    public function init()
    {
        $this->sourcePath = '@app/themes/' . CZA_BACKEND_THEME . '/assets/org_chart';
        parent::init();
    }
}
