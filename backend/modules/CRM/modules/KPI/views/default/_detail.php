<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


?>
<div class="user-kpi-model-detail">

    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
                'id',
            'grp_id',
            'join_user_id',
            'invite_user_id',
            'grp_station_id',
            'c1_id',
            'dues',
            'type',
            'state',
            'status',
            'position',
            'created_at',
            'updated_at',
    ],
    ]) ?>

</div>

