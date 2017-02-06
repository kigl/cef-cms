<?php
use yii\widgets\Menu;
?>

<?php
if ($data) {
    echo Menu::widget([
        'options' => $options,
        'activateParents' => true,
        'items' => $data,
        'encodeLabels' => false,
    ]);
}
?>

