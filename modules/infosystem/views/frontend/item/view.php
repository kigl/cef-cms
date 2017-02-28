<?php
//var_dump($data['model']->className());

?>

<?= \app\modules\comment\widgets\frontend\comment\Widget::widget([
    'modelClass' =>$data['model']->className(),
    'itemId' => $data['model']->id,
]);?>
