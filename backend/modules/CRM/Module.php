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
            'fe-user' => [
                'class' => 'backend\modules\CRM\modules\FeUser\Module',
            ],
            'grp' => [
                'class' => 'backend\modules\CRM\modules\GRP\Module',
            ],
        ];
        // custom initialization code goes here
    }
}
