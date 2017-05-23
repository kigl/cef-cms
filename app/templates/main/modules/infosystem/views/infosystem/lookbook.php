<?php
use yii\widgets\ListView;

$this->setTitle($data['model']->meta_title);
$this->setMetaDescription($data['model']->meta_description);
$this->setPageHeader($data['model']->name);
$this->params['breadcrumbs'] = $data['breadcrumbs'];
?>

<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?= $data['model']->content; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= ListView::widget([
                    'itemView' => '_lookbook',
                    'options' => ['class' => 'news-list'],
                    'summaryOptions' => ['class' => 'margin-bottom-10 text-right'],
                    'dataProvider' => $data['dataProviderGroup'],
                    'layout' => "{summary}\n{items}\n<div class='text-center'>{pager}</div>",
                    'sorter' => [
                        'options' => ['class' => 'list-inline panel'],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
