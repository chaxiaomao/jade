<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


?>
<div class="grpmodel-detail">

    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
                'id',
            'type',
            'attributeset_id',
            'province_id',
            'city_id',
            'district_id',
            'code',
            'label',
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

