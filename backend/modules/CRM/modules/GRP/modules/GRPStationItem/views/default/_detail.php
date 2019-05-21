<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


?>
<div class="grpstation-item-model-detail">

    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
                'id',
            'grp_station_id',
            'user_id',
            'label',
            'state',
            'status',
            'position',
            'created_at',
            'updated_at',
    ],
    ]) ?>

</div>

