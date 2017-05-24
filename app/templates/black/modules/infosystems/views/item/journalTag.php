<?php
use yii\helpers\Html;

/*
$this->setTitle($data['model']->meta_title);
$this->setMetaDescription($data['model']->meta_description);
$this->setPageHeader($data['model']->name);
$this->params['breadcrumbs'] = $data['breadcrumbs'];
*/
?>

<div class="content">
    <div class="container journal-group">
        <div class="row margin-top-20">
            <div class="col-md-12">
                <?= $this->render('@app/templates/black/modules/infosystem/views/group/_journalListView', ['data' => $data]);?>
            </div>
        </div>
    </div>
</div>