<?php

namespace backend\modules\CRM\modules\GRP\widgets;

use common\models\c2\statics\GRPType;
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

    public $grpModel;

    public function getTabItems() {
        $items = [];

        if ($this->withTranslationTabs) {
            $items[] = $this->getTranslationTabItems();
        }

        if ($this->withProfileTab) {
            $items[] = $this->getProfileTab();
        }

        if ($this->withBaseInfoTab) {

            if ($this->model->type == GRPType::TYPE_BRANCH) {
                $items[] = [
                    'label' => Yii::t('app.c2', 'Base Information'),
                    'content' => $this->controller->renderPartial('_branch_form_wc', [ 'model' => $this->model, 'grpModel' => $this->grpModel]),
                    'active' => true,
                ];
            } else {
                $items[] = [
                    'label' => Yii::t('app.c2', 'Base Information'),
                    'content' => $this->controller->renderPartial('_form', [ 'model' => $this->model,]),
                    'active' => true,
                ];
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