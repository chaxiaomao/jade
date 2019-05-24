<?php

namespace backend\modules\CRM\modules\GRP;

/**
 * grp module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'backend\modules\CRM\modules\GRP\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->modules = [
            'grp-station' => [
                'class' => 'backend\modules\CRM\modules\GRP\modules\GRPStation\Module',
            ],
            'grp-station-item' => [
                'class' => 'backend\modules\CRM\modules\GRP\modules\GRPStationItem\Module',
            ],
        ];
        // custom initialization code goes here
    }
}
