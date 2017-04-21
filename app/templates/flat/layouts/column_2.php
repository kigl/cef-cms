<?php
use yii\widgets\Menu;
use yii\helpers\Html;
use app\core\widgets\Alert;

?>

<?php $this->beginContent('@app/templates/flat/layouts/main.php'); ?>
    <div calss="row">
        <div class="col-md-3">
            sidebar
        </div>
        <div class="col-md-9">
            <?= Alert::widget(); ?>

            <?= Html::encode($this->getTitle()); ?>

            <?= $content; ?>

        </div>
    </div>
<?php $this->endContent(); ?>