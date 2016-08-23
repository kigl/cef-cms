<?php
use yii\helpers\Html;
?>

<?php echo Html::dropDownList('role', '', $model->getRoles(), array('size' => 10));?>