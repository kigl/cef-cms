<?php
$this->params['toolbar'] = [
    [
        'label' => Yii::t('user', 'Toolbar field'),
        'url' => ['field/manager'],
    ],
    ['label' => Yii::t('user', 'Toolbar rbac'), 'url' => ['rbac/manager']],
];
?>


<?php $this->beginContent('@app/modules/backend/views/layouts/column_2.php');?>
<?= $content;?>
<?php $this->endContent();?>
