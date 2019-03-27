<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


?>
<div class="chess-model-detail">

    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
                'id',
            'type',
            'lord_id',
            'elder_id',
            'chieftain_id',
            'attributeset_id',
            'province_id',
            'city_id',
            'district_id',
            'code',
            'label',
            'biz_registration_number',
            'product_style',
            'tel',
            'open_id',
            'wechat_open_id',
            'geo_longitude',
            'geo_latitude',
            'geo_marker_color',
            'created_by',
            'updated_by',
            'status',
            'position',
            'created_at',
            'updated_at',
    ],
    ]) ?>

</div>

