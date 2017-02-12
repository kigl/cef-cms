<?php
$this->params['toolbar'] = [
    ['label' => Yii::t('shop', 'Toolbar property'), 'url' => ['property/manager']],
    ['label' => Yii::t('shop', 'Toolbar order'), 'url' => ['order/manager']],
];
?>


<?php $this->beginContent('@app/modules/backend/views/layouts/column_2.php');?>
<?= $content;?>
<?php $this->endContent();?>
