<?php

namespace backend\modules\CRM\modules\Chess;

/**
 * chess module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'backend\modules\CRM\modules\Chess\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->modules = [
            'user-chess-rs' => [
                'class' => 'backend\modules\CRM\modules\Chess\modules\UserChessRs\Module',
            ],
            'user-development' => [
                'class' => 'backend\modules\CRM\modules\Chess\modules\UserDevelopment\Module',
            ],
            'user-profit' => [
                'class' => 'backend\modules\CRM\modules\Chess\modules\UserProfit\Module',
            ],

        ];
        // custom initialization code goes here
    }
}
