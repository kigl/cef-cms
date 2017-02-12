<?php
use yii\helpers\ArrayHelper;
use yii\widgets\Menu;
?>

<?php
if ($data) {
    echo Menu::widget([
        'options' => ArrayHelper::merge($options, ['class' => $modelMenu->class]),
        'activateParents' => true,
        'items' => $data,
        'encodeLabels' => false,
    ]);
}
?>

