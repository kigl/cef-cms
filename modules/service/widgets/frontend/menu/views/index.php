<?php
use yii\widgets\Menu;
?>

<?php
if ($data) {
    echo Menu::widget([
        'activateParents' => true,
        'items' => $data,
    ]);
}
?>

