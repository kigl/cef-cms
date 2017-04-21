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
            $('.show-in-modal').click(function (event) {
                var modal = $('.modal-body');

                $('#show-content-modal').modal('show');
                /*
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('href'),
                    async: false,
                    success: function (data) {
                        modal.html(data);
                    }
                });
                */
                modal.load($(this).attr('href'));
                return false;
            });
        });"
);
?>
