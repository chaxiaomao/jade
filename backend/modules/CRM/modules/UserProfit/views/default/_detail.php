<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


?>
<div class="user-profit-model-detail">

    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
                'id',
            'type',
            'user_id',
            'income',
            'state',
            'status',
            'created_at',
            'updated_at',
    ],
    ]) ?>

</div>

