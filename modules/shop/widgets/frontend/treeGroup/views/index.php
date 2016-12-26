<?php
use yii\widgets\Menu;
use app\modules\shop\widgets\frontend\treeGroup\asset\Asset;

Asset::register($this);
?>

<?= Menu::widget([
    'items' => $data,
    'activateParents' => true,
    'options' => $options,
])?>
