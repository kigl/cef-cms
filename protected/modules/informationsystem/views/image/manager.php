<?php
use yii\widgets\ListView;
use yii\bootstrap\Modal;


$this->params['breadcrumbs'] = $breadcrumbs;

$this->params['actionBar'] = [
	[
		'label' => '<i class="glyphicon glyphicon-plus"></i> ' . Yii::t('main', 'Button create'),
		'url' => ['image/create', 'group_id' => $group_id],
		'visible' => !Yii::$app->user->isGuest,
	],
];

$this->registerJs("
	$('.view-item').click(function() {
	    var url = $(this).attr('href');
	    var modal = $('.modal-body');
	    $.get(url, function(data) {
	        modal.html(data);
	    });
			$('.modal').modal('show');
	    return false;
	});
");
?>

<?= Modal::widget(['size' => Modal::SIZE_LARGE]);?>
<div class="row invormationsystem-list invormationsystem-list-image">
	<?= ListView::widget([
				'dataProvider' => $dataProvider,
				'itemView' => '_item',
				'layout' => "{summary}\n{items}\n<div class='col-md-12 text-center'>{pager}</div>",
	]);?>
</div>
