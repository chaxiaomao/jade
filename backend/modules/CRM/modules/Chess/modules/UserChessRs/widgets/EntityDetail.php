<?php

namespace backend\modules\CRM\modules\Chess\modules\UserChessRs\widgets;

use common\models\c2\statics\FeUserType;
use Yii;
use cza\base\widgets\ui\common\part\EntityDetail as DetailWidget;

/**
 * Entity Detail Widget
 *
 * @author Ben Bi <ben@cciza.com>
 * @link http://www.cciza.com/
 * @copyright 2014-2016 CCIZA Software LLC
 * @license
 */
class EntityDetail extends DetailWidget
{
    public $withTranslationTabs = false;

    public $withProfileTab = false;

    public function getTabItems()
    {
        $items = [];

        if ($this->withTranslationTabs) {
            $items[] = $this->getTranslationTabItems();
        }

        if ($this->withProfileTab) {
            $items[] = $this->getProfileTab();
        }

        if ($this->withBaseInfoTab) {

            switch ($this->model->type) {
                case FeUserType::TYPE_LORD:
                    $items[] = [
                        'label' => Yii::t('app.c2', 'Base Information'),
                        'content' => $this->controller->renderPartial('_lord_form', ['model' => $this->model,]),
                        'active' => true,
                    ];
                    break;
                default:
                    $items[] = [
                        'label' => Yii::t('app.c2', 'Base Information'),
                        'content' => $this->controller->renderPartial('_development_form', ['model' => $this->model,]),
                        'active' => true,
                    ];
                    break;
            }
        }

        $items[] = [
            'label' => '<i class="fa fa-th"></i> ' . $this->tabTitle,
            'onlyLabel' => true,
            'headerOptions' => [
                'class' => 'pull-left header',
            ],
        ];

        return $items;
    }
}