<?php
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;

?>

<?= Modal::widget(ArrayHelper::merge([
    'options' => [
        'id' => 'show-content-modal',
    ],
],
    $options));
?>

<?php

$this->registerJs("
        $( function () {
            $('.show-in-modal').click(function (data) {
                var url = $(this).attr('href');
                var modal = $('.modal-body');

                $('#show-content-modal').modal('show');
                $.ajax({
                    url: url,
                    success: function (data) {
                        modal.html(data);
                    }
                });

                return false;
            });
        });"
);
?>
