<?php

namespace backend\modules\CRM\modules\UserDegree\widgets;

use common\models\c2\entity\FeUserModel;
use common\models\c2\entity\UserDegreeRsModel;
use common\models\c2\search\UserDegreeRsSearch;
use Yii;
use cza\base\widgets\ui\common\part\EntityDetail as DetailWidget;
use yii\web\NotFoundHttpException;

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
    public $withUsersTab = false;
    public $params;
    protected $modelClass = 'common\models\c2\entity\UserDegreeRsModel';

    public function getTabItems()
    {
        $items = [];
        if ($this->withTranslationTabs) {
            $items[] = $this->getTranslationTabItems();
        }

        if ($this->withProfileTab) {
            $items[] = $this->getProfileTab();
        }

        if ($this->withUsersTab) {
            $items[] = $this->getUsersTab();
        }

        if ($this->withBaseInfoTab) {
            $items[] = [
                'label' => Yii::t('app.c2', 'Base Information'),
                'content' => $this->controller->renderPartial('_node_base', ['model' => $this->model, 'params' => $this->params,]),
                'active' => true,
            ];
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

    public function getUsersTab()
    {
        if (!isset($this->_tabs['USERS_TAB'])) {
            if (!$this->model->isNewRecord) {
                $searchModel = new UserDegreeRsSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                $this->_tabs['USERS_TAB'] = [
                    'label' => Yii::t('app.c2', 'User List'),
                    'content' => $this->controller->renderPartial('_node_users_index', [
                        'model' => $this->retrieveModel(),
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'params' => $this->params,
                    ]),
                    'enable' => true,
                ];
            } else {
                $this->_tabs['USERS_TAB'] = [
                    'label' => Yii::t('app.c2', 'User List'),
                    'content' => "",
                    'enable' => false,
                ];
            }
        }

        return $this->_tabs['USERS_TAB'];
    }

    /**
     *
     * @param type $id
     * @param type $allowReturnNew
     * @return \cza\base\components\controllers\backend\modelClass
     * @throws NotFoundHttpException
     */
    public function retrieveModel($id = null, $allowReturnNew = true) {
        if (!is_null($id)) {
            $model = $this->findModel($id);
        } elseif (!$allowReturnNew) {
            throw new NotFoundHttpException('The requested page does not exist.');
        } else {
            $model = new $this->modelClass;
            $model->loadDefaultValues();
        }

        return $model;
    }

}