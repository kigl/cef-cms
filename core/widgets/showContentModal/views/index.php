<?php
use yii\bootstrap\Modal;
?>

<?= Modal::widget([
    'options' => [
        'id' => 'show-content-modal',
        ],
]); ?>

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
        });");

/*
$this->registerJs("
$( function () {
    $('.show-in-modal').click(function (data) {
        $('#show-content-modal').modal('show');
        var url = $(this).attr('href');
        var modal = $('.modal-body');
        $.get(url, function (data) {
            modal.html(data);
        });
        return false;
    });
    });
")
*/
?>
