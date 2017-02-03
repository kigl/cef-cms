<?php
$this->params['toolbar'] = [
    ['label' => '<i class="fa fa-cogs"></i> ' . Yii::t('shop', 'Toolbar property'), 'url' => ['property/manager']],
    ['label' => Yii::t('shop', 'Toolbar order'), 'url' => ['order/manager']],
];
?>

<?php $this->beginContent('@app/modules/backend/views/layouts/column_2.php'); ?>
<?= $content; ?>
<?php $this->endContent(); ?>

