<?php
use yii\widgets\Menu;

?>

<?php
echo Menu::widget([
    'options' => ['class' => 'sidebar-menu'],
    'items' => $data,
    'encodeLabels' => false,
    'activateParents' => true,
]);
?>
