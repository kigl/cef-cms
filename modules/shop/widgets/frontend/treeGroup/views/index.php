<?php
use yii\widgets\Menu;
?>

<?= Menu::widget([
    'items' => $data,
    'activateParents' => true,
    'options' => $options,
])?>
