<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/15
 * Time: 10:10
 */
$currentChess = Yii::$app->session->get('chess', array('chess_id' => 0, 'chess_name' => Yii::t('app.c2', 'Select Chess')));
?>


<div class="btn-group">
    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?= $currentChess['chess_name'] ?>
    </button>
    <div class="dropdown-menu dropdown-menu-right">
        <?php foreach($model as $item): ?>
            <?php if ($currentChess['chess_id'] == $item->id): ?>
            <?php else: ?>
                <a href="<?= \yii\helpers\Url::toRoute(['/site/chess', 'id' => $item->id]) ?>" class="dropdown-item"><?= $item->label ?></a>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

</div>
