<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

/**
 * @var $model \dektrium\rbac\models\Rule
 * @var $this  \yii\web\View
 */

$this->title = Yii::t('app.c2', 'Update rule');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app.c2', 'Rules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?php $this->beginContent('@app/modules/Sys/modules/Rbac/views/layout.php') ?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>

<?php $this->endContent() ?>
