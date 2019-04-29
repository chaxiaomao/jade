<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/8
 * Time: 22:44
 */
?>

<div class="card">
    <div class="card-img-top bg-recommend" id="m_recommend-broad">
<!--        <div id="m_spinner" class="spinner-border text-warning" role="status" >-->
<!--            <span class="sr-only">Loading...</span>-->
<!--        </div>-->
        <div id="m_spinner" class="bg-recommend" style="display: none;">
            <svg class="spinner" width="45px" height="45px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
            </svg>
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
