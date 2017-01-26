<?php
use yii\widgets\DetailView;
use kartik\grid\GridView;

?>

<ul class="nav nav-tabs">
    <li class="active">
        <a href="#detail" data-toggle="tab"><?= Yii::t('shop', 'Tab order view detail'); ?></a>
    </li>
    <li>
        <a href="#items" data-toggle="tab"><?= Yii::t('shop', 'Tab order view items'); ?></a>
    </li>
</ul>

<div class="tab-content">
    <div class="tab-pane active" id="detail">
        <?= DetailView::widget([
            'model' => $data->getModel(),
            'attributes' => [
                'id',
                'create_time:dateTime',
                'update_time:dateTime',
                'sum:currency',
                'status',
                'country',
                'city',
                'region',
                'postcode',
                'address',
                'phone',
                'user_id'
            ],
        ]); ?>
    </div>
    <div class="tab-pane" id="items">
        <?= GridView::widget([
            'dataProvider' => $data->getDataProvider(),
            'showPageSummary' => true,
            'columns' => [
                'id',
                'name',
                'price:currency',
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'qty',
                    'pageSummary' => true,
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'label' => Yii::t('shop', 'Sum'),
                    'format' => 'currency',
                    'value' => function ($data) {
                        return $data->price * $data->qty;
                    },
                    'pageSummary' => true,
                ],
            ],
        ]); ?>
    </div>
</div>
