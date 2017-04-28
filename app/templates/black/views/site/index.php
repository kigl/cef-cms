<?php
$this->setTitle($data['model']->meta_title);
$this->setMetaDescription($data['model']->meta_description);
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?= \app\modules\infosystem\widgets\Slide::widget([
                'groupId' => 5,
                'options' => ['class' => 'slide'],
            ]) ?>
        </div>
    </div>

    <div class="content margin-top-10">
        <div class="row">
            <div class="col-md-12">
                <?= $data['model']->content;?>
            </div>
        </div>
    </div>
</div>