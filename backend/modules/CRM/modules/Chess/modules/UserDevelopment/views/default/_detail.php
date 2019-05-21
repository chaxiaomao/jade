<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


?>
<div class="user-development-model-detail">

    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
                'id',
            'user_chess_rs_id',
            'chess_id',
            'user_id',
            'parent_id',
            'type',
            'state',
            'status',
            'position',
            'created_at',
            'updated_at',
    ],
    ]) ?>

</div>

