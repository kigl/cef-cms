<?php
use yii\widgets\ListView;
use yii\widgets\Pjax;
use app\modules\forum\widgets\frontend\fastAnswer\Widget as FastAnswer;

$this->params['breadcrumbs'] = $breadcrumbs;

$this->params['actionBar'] = [
	[
		'label' => '<i class="fa fa-plus"></i>',
		'url' => ['post/create', 'topicId' => $id],
	],
];
?>

<?php
    $this->registerJs(
        '$("document").ready(function(){
            $("#new_post").on("pjax:end", function() {
            $.pjax.reload({container:"#posts"});
        });
    });'
    );
?>

<div class="bg-content">
	<?php Pjax::begin(['id' => 'posts']);?>
	<?= ListView::widget([
		'dataProvider' => $dataProvider,
		'itemView' => '_post',
		'itemOptions' => ['class' => 'items'],
	]);?>
	<?php Pjax::end();?>
</div>

<?php if (Yii::$app->user->can('register')) :?>
	<div class="margin-top-20">
		<?php Pjax::begin(['id' => 'new_post']);?>
		<?= FastAnswer::widget(['topicId' => $id]);?>
		<?php Pjax::end();?>
	</div>
<?php endif;?>

