<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


?>
<div class="user-sum-apply-model-detail">

    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
                'id',
            'type',
            'user_id',
            'apply_sum',
            'bank_name',
            'hash',
            'confirmed_at',
            'name',
            'mobile_number',
            'brank_card_number',
            'transfer_rate',
            'received_sum',
            'state',
            'status',
            'created_at',
            'updated_at',
    ],
    ]) ?>

</div>

