<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


?>
<div class="user-profit-item-model-detail">

    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
                'id',
            'type',
            'kpi_id',
            'grp_id',
            'user_id',
            'income',
            'state',
            'status',
            'created_at',
            'updated_at',
    ],
    ]) ?>

</div>

