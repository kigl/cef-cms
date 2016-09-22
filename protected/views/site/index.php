<?php use yii\jui\Dialog;?>

<h1> site controller</h1>

<?php
 Dialog::begin([
    'clientOptions' => [
        'modal' => true,
    ],
]);

echo 'Dialog contents here...';

Dialog::end();?>

