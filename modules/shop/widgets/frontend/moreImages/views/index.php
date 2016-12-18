<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 16.12.2016
 * Time: 21:43
 */
?>

<?php foreach ($model as $image) :?>
    <img src="<?= $image->getFileUrl();?>" class="product-more-image"/>
<?php endforeach;?>
