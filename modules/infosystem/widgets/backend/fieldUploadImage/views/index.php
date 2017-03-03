<?php
use yii\helpers\Html;
use kartik\file\FileInput;

?>
<?php if ($model->getBehavior($widget->behaviorName)->fileExist()) : ?>
    <div>
        <div class="img-thumbnail">
            <div>
                <div class="pull-right">
                    <label>
                        Удалить <input type="checkbox"
                                       name="<?= $model->getBehavior($widget->behaviorName)->getDeleteKey() ?>">
                    </label>
                </div>
            </div>
            <?= Html::a(
                Html::img($model->getBehavior($widget->behaviorName)->getFileUrl(), ['style' => 'width: 200px']),
                $model->getBehavior($widget->behaviorName)->getFileUrl(),
                ['target' => '_blanck']
            ); ?>
        </div>
    </div>
    <br/>
<?php endif; ?>

<?= FileInput::widget([
    'model' => $model,
    'attribute' => $attribute,
]) ?>


