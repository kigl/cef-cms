<?php
$this->setTitle('Список групп');
$this->setMetaDescription('Список групп описание');
$this->setPageHeader('Список групп');
$this->setBreadcrumbs([['label' => 'Список групп']]);
?>
<ul>
    <?php foreach ($model as $group) : ?>
        <li><?= $group->name ?></li>
    <?php endforeach; ?>
</ul>