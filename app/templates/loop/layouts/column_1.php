<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\core\widgets\Alert;

?>

<?php $this->beginContent('@app/templates/black/layouts/main.php'); ?>
    <div class="header margin-top-30">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <a href="<?= Url::to(['/']) ?>">
                        <img src="<?= $this->theme->baseUrl; ?>/web/images/logo.png"/>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="margin-top-10">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php //echo Alert::widget(); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php
                    if (isset($this->params['breadcrumbs'])) {
                        echo \yii\widgets\Breadcrumbs::widget([
                            'links' => $this->params['breadcrumbs'],
                        ]);
                    } ?>
                </div>
            </div>
        </div>
        <?= $content; ?>
    </div>
    <div class="footer margin-top-10 margin-bottom-20">
        <?= $this->render('footer'); ?>
    </div>
<?php $this->endContent(); ?>