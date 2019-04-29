<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


?>
<div class="user-chess-rs-model-detail">

    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
                'id',
            'user_id',
            'chess_id',
            'type',
            'state',
            'status',
            'position',
            'created_at',
            'updated_at',
    ],
    ]) ?>

</div>

