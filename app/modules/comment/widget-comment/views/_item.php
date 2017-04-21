<?php
use yii\helpers\Html;

?>

<?php foreach ($data['items'] as $model) : ?>
    <?php if ($model->parent_id == $parentId) : ?>
            <div class="comment-item media">
                <input type="hidden" value="<?= $model->id; ?>"/>
                <div class="pull-left">
                    avatar
                </div>
                <div class="comment-detail media-body">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="list-inline">
                                <li><i class="fa fa-user"></i>&nbsp;<b><?= Html::encode($model->user->login); ?></b></li>
                                <li><?= Yii::$app->formatter->asRelativeTime($model->create_time); ?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="comment-content">
                        <div class="row">
                            <div class="col-md-12">
                                <?= Html::encode($model->content); ?>
                            </div>
                        </div>
                    </div>
                    <div class="comment-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <?php if (!Yii::$app->user->isGuest) : ?>
                                    <a href="javascript:void(0);" class="link-answer">
                                        <?= Yii::t('comment', 'Link answer'); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <?= $this->render('_item', [
                        'data' => $data,
                        'parentId' => $model->id,
                    ]) ?>
                </div>
            </div>
    <?php endif; ?>
<?php endforeach; ?>
