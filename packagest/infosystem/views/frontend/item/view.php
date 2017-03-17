<?php
//var_dump($data['model']->className());

?>

<?= \kigl\cef\module\comment\widgets\frontend\comment\Widget::widget([
    'modelClass' =>$data['model']->className(),
    'itemId' => $data['model']->id,
]);?>
