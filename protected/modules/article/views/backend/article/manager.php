<?php

use yii\helpers\Html;
use app\modules\main\widgets\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\page\models\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('main', 'Article');
$this->breadcrumbs = ['label' => 'Статьи'];

$this->toolbar = [
    ['label' => '<i class="glyphicon glyphicon-plus"></i> '.Yii::t('main', 'button add'), 'url' => ['create']],
];
?>

<div class="page-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            'title',
						[
							'attribute' => 'author_id',
							'value' => 'author.name',
						],
            'url:text',
            'id',
            [
           		'headerOptions' => ['style' => 'width: 50px'],
           		'class' => 'yii\grid\ActionColumn',
            	'template' => '{update} {delete}',
            ],
        ],
    ]); ?>
</div>
