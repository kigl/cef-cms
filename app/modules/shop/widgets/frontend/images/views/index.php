<?php foreach ($model as $image) :?>
    <img src="<?= $image->getFileUrl();?>" class="product-more-image"/>
<?php endforeach;?>
