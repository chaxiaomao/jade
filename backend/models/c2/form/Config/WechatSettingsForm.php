<?php

namespace backend\models\c2\form\Config;

use Yii;
use backend\models\c2\form\Config\Form as BaseForm;
use Da\QrCode\QrCode;
use yii\helpers\ArrayHelper;
use common\models\c2\entity\EntityAttachmentImage;

class WechatSettingsForm extends BaseForm {

    protected $_prefix = 'wechat';
    public $id = '1';
    public $applyDistrbutorQrcode;
    public $applyDistrbutorQrcodeImage;
    public $applyMerchantQrcode;
    public $applyMerchantQrcodeImage;
    public $nearestShopQrcode;
    public $nearestShopQrcodeImage;
    public $wechatSubscribeQrcode;
    public $wechatSubscribeQrcodeImage;

    public function rules() {
        return [
            [['applyMerchantQrcode', 'applyMerchantQrcodeImage',], 'string', 'max' => 255],
            [['applyDistrbutorQrcode', 'applyDistrbutorQrcodeImage',], 'string', 'max' => 255],
            [['wechatSubscribeQrcode', 'wechatSubscribeQrcodeImage',], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels() {
        return [
            'applyMerchantQrcodeImage' => Yii::t('app.c2', 'Apply Merchant Qrcode Image'),
            'applyDistrbutorQrcodeImage' => Yii::t('app.c2', 'Apply Distributor Qrcode Image'),
            'nearestShopQrcodeImage' => Yii::t('app.c2', 'Nearest Shop Qrcode Image'),
            'wechatSubscribeQrcode' => Yii::t('app.c2', 'Wechat Subscribe Qrcode'),
        ];
    }

    public function behaviors() {

        return ArrayHelper::merge(parent::behaviors(), [
                    'attachmentsBehavior' => [
                        'class' => \backend\components\behaviors\ConfigAttachmentBehavior::className(),
                        'attributesDefinition' => [
                            'applyDistrbutorQrcodeImage' => [
                                'class' => EntityAttachmentImage::className(),
                                'validator' => 'image',
                                'enableVersions' => false, // determine to generate difference size images
                                'rules' => [
                                    'maxFiles' => 1,
                                    'extensions' => Yii::$app->params['config']['upload']['imageWhiteExts'],
                                    'maxSize' => Yii::$app->params['config']['upload']['maxFileSize'],
                                ]
                            ],
                            'applyMerchantQrcodeImage' => [
                                'class' => EntityAttachmentImage::className(),
                                'validator' => 'image',
                                'enableVersions' => false, // determine to generate difference size images
                                'rules' => [
                                    'maxFiles' => 1,
                                    'extensions' => Yii::$app->params['config']['upload']['imageWhiteExts'],
                                    'maxSize' => Yii::$app->params['config']['upload']['maxFileSize'],
                                ]
                            ],
                            'nearestShopQrcodeImage' => [
                                'class' => EntityAttachmentImage::className(),
                                'validator' => 'image',
                                'enableVersion' => false,
                                'rules' => [
                                    'maxFiles' => 1,
                                    'extension' => Yii::$app->params['config']['upload']['imageWhiteExts'],
                                    'maxSize' => Yii::$app->params['config']['upload']['maxFileSize'],
                                ]
                            ],
                            'wechatSubscribeQrcode' => [
                                'class' => EntityAttachmentImage::className(),
                                'validator' => 'image',
                                'enableVersion' => false,
                                'rules' => [
                                    'maxFiles' => 1,
                                    'extension' => Yii::$app->params['config']['upload']['imageWhiteExts'],
                                    'maxSize' => Yii::$app->params['config']['upload']['maxFileSize'],
                                ]
                            ],
                        ],
                    ],
        ]);
    }

    public function beforeSave() {
        return parent::beforeSave();
    }

    public function getUploadPath() {
//        $path = Yii::getAlias(Yii::$app->params['config']['upload']['storePath']) . '/common';
        $path = Yii::getAlias(Yii::$app->params['config']['upload']['tempPath']);

        // save images to imagePath
        if (!file_exists($path)) {
            if (!@mkdir($path, 0775, true)) {
                throw new Exception("Cannot create dir: {v}");
            }
        }
        return $path;
    }

    public function generateQrCode($params = [], $qrOptions = []) {
        if (!isset($params['codeAttribute'])) {
            throw new \yii\base\ErrorException("Missing codeAttribute");
        }
        if (!isset($params['imageAttribute'])) {
            throw new \yii\base\ErrorException("Missing imageAttribute");
        }
        $codeAttribute = $params['codeAttribute'];
        $imageAttribute = $params['imageAttribute'];

        if (empty($params['content'])) {
            $content = 'empty';
        } else {
            $content = $params['content'];
        }

        $options = array_merge_recursive(['level' => 0, 'size' => 200, 'margin' => 10,], $qrOptions);
        $fileName = Yii::$app->security->generateRandomString(8) . '.png';
        $filePath = $this->getUploadPath() . '/' . $fileName;

        $qrCode = (new QrCode($content))
                ->setSize($options['size'])
                ->setMargin($options['margin']);
        $qrCode->writeFile($filePath);

        $this->deleteByRefAttribute($imageAttribute);  // invoke attachement behavior method to delete
        $this->attachFile($filePath, $imageAttribute, $params);  // invoke attachement behavior method to save
        
        $this->{$codeAttribute} = $content;
        $this->{$imageAttribute} = $this->getOneAttachment($imageAttribute)->getOriginalUrl();
        if (!$this->save()) {
            throw new \yii\web\HttpException("Cannot be saved!");
        }
    }

}
