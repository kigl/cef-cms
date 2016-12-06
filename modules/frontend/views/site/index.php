<?php
use yii\helpers\Html;
$this->setTitle('Сайт без имени title');
$this->setMetaDescription('Сайт без имени description');
$this->setPageHeader('Сайт без имени page header');

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

