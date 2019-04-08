<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/8
 * Time: 22:44
 */
?>

<div class="card" style="width: 96%;margin: 10px auto 0;">
    <div id="recommend-broad" class="card-img-top bg-recommend">

    </div>
    <div class="card-body">
        <p class="card-text red"><?= Yii::t('app.c2', 'Recommend code has been expired after 15min') ?></p>
        <button id="gen" class="btn btn-info w100"><?= Yii::t('app.c2', 'Generate') ?></button>
    </div>
</div>


<?php
$url = \yii\helpers\Url::toRoute(['/site/recommend-code-captcha']);
$js = <<<JS
// $('#gen').click(function generate() {
//
// });

$(document).off('click', '#gen').on('click','#gen',function(){
    $.post('{$url}', function(data) {
      if (data._data.data) {
          $('#recommend-broad').html(data._data.data)
      } 
    });
});

JS;

$this->registerJs($js);

?>
