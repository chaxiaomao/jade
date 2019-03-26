<?php

namespace backend\modules\CRM;

/**
 * crm module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'backend\modules\CRM\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->modules = [
            'lord' => [
                'class' => 'backend\modules\CRM\modules\Lord\Module',
            ],
            'chess' => [
                'class' => 'backend\modules\CRM\modules\Chess\Module',
            ],
        ];
        // custom initialization code goes here
    }
}
