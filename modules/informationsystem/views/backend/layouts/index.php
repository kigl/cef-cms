<?php
$this->params['toolbar'] = [
    [
        'label' => Yii::t('informationsystem', 'Tag toolbar'),
        'url' => ['manager/tag'],
    ]
];
?>

<?php $this->beginContent('@app/modules/backend/views/layouts/column_2.php');?>
<?= $content;?>
<?php $this->endContent();?>
