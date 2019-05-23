<?php
/**
 * Created by PhpStorm.
 * User: jerrygo
 * Date: 19-5-23
 * Time: 下午5:01
 */
$this->title = Yii::t('app.c2', 'My Kpi')
?>
<div class="container-fluid">

    <h4><?= Yii::t('app.c2', 'Recommend Code') ?></h4>
    <div class="input-group">
        <input id="rcd_code" readonly type="text" class="form-control" value="<?= $code ?>">
        <span class="input-group-btn">
        <button class="btn btn-default" type="button" onclick="copy()"><?= Yii::t('app.c2', 'Copy') ?></button>
      </span>
    </div>

</div>



<script type="application/javascript">

    function copy() {
        var code =document.getElementById("rcd_code");
        code.select();
        document.execCommand('copy');
    }
</script>
