<?php

echo \kigl\cef\module\backend\widgets\toolbar\Widget::widget([
    'options' => ['class' => 'list-inline well well-sm'],
]); ?>

<table class="table table-bordered table-striped">
    <tbody>
    <tr>
        <td>ID</td>
        <td><?= $this->module->id;?></td>
    </tr>
    <tr>
        <td>Название модуля</td>
        <td><?= $this->module->getName();?></td>
    </tr>
    <tr>
        <td>Описание модуля</td>
        <td><?= $this->module->getDescription();?></td>
    </tr>
    <tr>
        <td>Версия</td>
        <td><?= $this->module->getVersion();?></td>
    </tr>
    </tbody>
</table>


