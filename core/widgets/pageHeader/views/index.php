<?php
use yii\helpers\Html;
?>

<?php
    if ($text !== '') {
        echo Html::tag('h1', $text, $options);
    }
?>
