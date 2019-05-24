<?php
/**
 * Created by PhpStorm.
 * User: jerrygo
 * Date: 19-5-23
 * Time: 下午5:01
 */
$this->title = Yii::t('app.c2', 'My Kpi');
$this->params['navbar'] = Yii::t('app.c2', 'Back');
?>
<div class="container-fluid">

    <h4><?= Yii::t('app.c2', 'My Invite Code') ?></h4>
    <p class="red"><?= Yii::t('app.c2', 'Though this code can invite user join {s1} grp.', ['s1' => $grpModel->label]) ?></p>
    <div class="input-group">
        <input id="rcd_code" readonly type="text" class="form-control" value="<?= $code ?>">
        <span class="input-group-btn">
        <button class="btn btn-default" type="button" onclick="copy()"><?= Yii::t('app.c2', 'Copy') ?></button>
      </span>
    </div>

    <h4><?= Yii::t('app.c2', 'My Developer') ?></h4>

    <ul class="media-list">
        <?php foreach ($models as $model): ?>
            <li class="media bottom-board pb10 pt10">
                <div class="media-left">
                    <a href="#">
                        <img class="media-object avatar60" src="/images/avatar.png" alt="...">
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading"><?= $model->joinUser->username ?>
                        <span class="label label-default"><?= \common\models\c2\statics\UserKpiStateType::getLabel($model->state) ?></span></h4>
                    <?= $model->joinUser->mobile_number ?>
                </div>
            </li>

        <?php endforeach; ?>
    </ul>

</div>



<script type="application/javascript">

    function copy() {
        var code =document.getElementById("rcd_code");
        code.select();
        document.execCommand('copy');
    }
</script>
