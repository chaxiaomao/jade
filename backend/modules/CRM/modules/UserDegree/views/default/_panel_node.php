<?php

use backend\modules\CRM\modules\UserDegree\widgets\EntityDetail;
use yii\helpers\Html;

?>
<?php

echo EntityDetail::widget([
    'model' => $model,
    'params' => $params,
    // 'withUsersTab' => true,
    // 'withHotSaleTab' => true,
]);
?>