<?php

namespace backend\modules\CRM\modules\UserProfit;

/**
 * user-profit module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'backend\modules\CRM\modules\UserProfit\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->modules = [
            'profit-item' => [
                'class' => 'backend\modules\CRM\modules\UserProfit\modules\ProfitItem\Module',
            ],
        ];
        // custom initialization code goes here
    }
}
