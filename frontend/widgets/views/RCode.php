<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/8
 * Time: 22:44
 */
?>

<div class="card" style="width: 96%;margin: 10px auto 0;">
    <div id="m_recommend-broad" class="card-img-top bg-recommend">
        <div id="m_spinner" class="spinner-border text-warning" role="status" style="display: none">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <div class="card-body">
        <p class="card-text red"><?= Yii::t('app.c2', 'Recommend code has been expired after 15min') ?></p>
        <button id="m_gen" class="btn btn-info w100"><?= Yii::t('app.c2', 'Generate') ?></button>
    </div>
</div>


<?php
$js = <<<JS
$(document).off('click', '#m_gen').on('click','#m_gen',function(){
    $.ajax({
        beforeSend: function() {
          $('#m_spinner').show()
        },
        type: "POST",
        async: true,
        url: '{$captchaAction}',
        success: function(data) {
          if (data._data.data) {
              $('#m_recommend-broad').html(data._data.data)
          } 
        },
        complete: function() {
          $('#m_spinner').hide()
        }
    });
});

JS;

$this->registerJs($js);

?>
