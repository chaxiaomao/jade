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
            'elder' => [
                'class' => 'backend\modules\CRM\modules\Elder\Module',
            ],
            'chieftain' => [
                'class' => 'backend\modules\CRM\modules\Chieftain\Module',
            ],
            'user-degree' => [
                'class' => 'backend\modules\CRM\modules\UserDegree\Module',
            ],

        ];
        // custom initialization code goes here
    }
}
