<?php
$this->setPageHeader($this->module->getName());
$this->params['toolbar'] = isset($this->module->toolbar['main']) ? $this->module->toolbar['main'] : null;
?>

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


