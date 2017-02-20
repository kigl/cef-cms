<?php
$this->params['toolbar'] = [
    [
        'label' => Yii::t('infosystem', 'Tag toolbar'),
        'url' => ['manager/tag'],
    ]
];
?>

<?php $this->beginContent('@app/modules/backend/views/layouts/column_2.php');?>
<?= $content;?>
<?php $this->endContent();?>
