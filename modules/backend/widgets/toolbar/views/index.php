<?php
use yii\widgets\Menu;

?>

<?php
if ($data) {
    echo Menu::widget([
        'options' => $options,
        'encodeLabels' => false,
        'linkTemplate' => '<a href="{url}" class="btn btn-default btn-sm">{label}</a>',
        'items' => $data,
    ]);
}
?>
