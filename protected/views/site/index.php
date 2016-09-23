<?php 
use yii\bootstrap\Modal;
use yii\helpers\Html;
?>

<?php $this->registerJs("
$('.view-item').click(function() {
    var url = $(this).attr('href');
    var modal = $('.modal');
    $.get(url, function(data) {
        modal.html(data).modal('show');
    });
    return false;
});
")?>

<div class="modal fade"></div>

<?= Html::a('test', ['/informationsystem/backend/create/item', 'informationsystem_id' => 'news'], ['class' => 'view-item']);?>
<h1> site controller</h1>

