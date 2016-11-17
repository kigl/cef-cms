<?php
use yii\helpers\Html;
?>

<?php
    if ($header !== '') {
        echo Html::tag('h1', $header, $options);
    }
?>
