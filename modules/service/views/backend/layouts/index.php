<?php
$this->params['toolbar'] = [
    ['label' => Yii::t('service', 'Toolbar menu'), 'url' => ['/backend/service/menu/menu/manager']],
    ['label' => Yii::t('service', 'Toolbar form'), 'url' => ['/backend/service/form/form/manager']],
];
?>


<?php $this->beginContent('@app/modules/backend/views/layouts/column_2.php');?>
<?= $content;?>
<?php $this->endContent();?>
