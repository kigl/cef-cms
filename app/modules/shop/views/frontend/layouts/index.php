<?php
use app\modules\shop\views\frontend\asset\Asset;

Asset::register($this);
?>

<?php $this->beginContent('@app/modules/frontend/views/layouts/column_2.php');?>
<?= $content;?>
<?php $this->endContent();?>
