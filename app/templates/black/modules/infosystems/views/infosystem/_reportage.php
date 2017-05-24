<?php
use yii\helpers\Html;

?>

<div class="col-md-4 margin-bottom-20">
    <div class="box">
        <h2 class="padding-20 margin-10"><?= Html::a($model->name, [
                '/infosystem/item/view',
                'id' => $model->id,
                'alias' => $model->alias,
                'infosystem_id' => $model->infosystem_id
            ]) ?></h2>
        <p><?= $model->description; ?></p>
    </div>
</div>