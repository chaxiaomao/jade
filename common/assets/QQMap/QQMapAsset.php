<?php
namespace common\assets\QQMap;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/13
 * Time: 8:46
 */
use yii\web\AssetBundle;
class QQMapAsset extends AssetBundle
{
    public $sourcePath = '@common/assets/QQMap/src';

    public $css = [];
    public $js = [
        'https://map.qq.com/api/js?v=2.ex',
        'https://3gimg.qq.com/lightmap/components/geolocation/geolocation.min.js',
        'js/map.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'cza\base\assets\AppAsset',
    ];
    public $publishOptions = [
        'forceCopy' => YII_DEBUG,
    ];

}