<?php
use yii\helpers\Html;

?>

<div class="row">
    <div class="col-md-12">
        <h2><?= Html::a($model->name, [
                '/infosystem/item/view',
                'id' => $model->id,
                'alias' => $model->alias,
                'infosystem_id' => $model->infosystem_id
            ]) ?></h2>
        <p><b><?= Yii::$app->formatter->asDate($model->date, 'long') ?></b></p>
        <p><?= $model->description; ?></p>
    </div>
</div>