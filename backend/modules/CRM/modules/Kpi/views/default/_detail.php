<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


?>
<div class="user-kpi-model-detail">

    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
                'id',
            'chess_id',
            'user_id',
            'recommend_user_id',
            'familiar_id',
            'chieftain_id',
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

