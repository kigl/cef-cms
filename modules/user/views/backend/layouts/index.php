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

<ul class="alert alert-danger">
    <li>Добавить аватарку</li>
    <li>Добавить required дополнительным полям</li>
</ul>

<?= $content;?>
<?php $this->endContent();?>
