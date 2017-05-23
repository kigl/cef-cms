<?php
$this->setTitle($data['model']->meta_title);
$this->setMetaDescription($data['model']->meta_description);
$this->setPageHeader($data['model']->name);
$this->params['breadcrumbs'] = $data['breadcrumbs'];
?>

<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?= $data['model']->content;?>
            </div>
        </div>
    </div>
</div>
