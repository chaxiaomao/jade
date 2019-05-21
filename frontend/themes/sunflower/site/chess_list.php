<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/6
 * Time: 21:48
 */
$this->title = Yii::t('app.c2', 'Chess list');
$this->params['navbar'] = Yii::t('app.c2', 'Back');
?>
    <div class="container">
        <?php foreach ($model as $item): ?>
            <div class="input-group">
      <span class="input-group-addon">
        <input name="chess_id" type="radio"
               value="<?= $item->chess->id ?>" <?= $item->chess_id == $item->chess->id ? 'checked' : '' ?>>
      </span>
                <input type="text" class="form-control" placeholder="<?= $item->chess->code ?>" readonly>
            </div>
        <?php endforeach; ?>
        <?php echo \yii\helpers\Html::button(Yii::t('app.c2', 'Save'), ['class' => 'btn btn-success btn-block mt10', 'id' => 'save']) ?>
    </div>

    <!-- 模态框（Modal） -->
    <div class="modal fade" id="tipsModal" tabindex="-1" role="dialog" aria-labelledby="tipsModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body red"><?= Yii::t('app.c2', 'Operated success') ?></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">X</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>

<?php
$js = <<<JS

$('#save').click(function() {
    var chess_id = $("input[name='chess_id']:checked").val();
  $.ajax({
    url: 'chess-change',
    method: 'post',
    dataType: 'json',
    data: {chess_id: chess_id},
    success: function(data) {
      if (data._meta.result === '0000') {
          $('#tipsModal').modal();
      } 
    }
  })
});


JS;
$this->registerJS($js);
?>