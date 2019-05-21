<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


?>
<div class="grpstation-model-detail">

    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
                'id',
            'grp_id',
            'type',
            'name',
            'label',
            'parent_station_id',
            'status',
            'position',
            'created_at',
            'updated_at',
    ],
    ]) ?>

</div>

