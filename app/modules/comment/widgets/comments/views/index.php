<?php
use yii\helpers\Url;

\app\modules\comment\widgets\comments\views\asset\Asset::register($this);
?>

    <div class="page-header h3">
        <?= Yii::t('app', 'Header comment ({count})', ['count' => $data['count']]); ?>
    </div>

<?= $this->render('_item', [
    'data' => $data,
    'parentId' => null,
]); ?>

<?php if (!Yii::$app->user->isGuest) : ?>
    <?= $this->render('_form', ['data' => $data]); ?>
<?php else : ?>
    <p class="alert alert-info">
        <a href="<?= Url::to(['/user/default/login']) ?>" class="alert-link">Войдите</a> или <a
                href="<?= Url::to(['/user/default/registration']) ?>" class="alert-link">зарегистрируйтесь</a> чтобы
        оставить комментарий.
    </p>
<?php endif; ?>