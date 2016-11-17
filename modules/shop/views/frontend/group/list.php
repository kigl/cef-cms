<?php
$this->setPageHeader('Список групп');
?>
<ul>
    <?php foreach ($model as $group) : ?>
        <li><?= $group->name ?></li>
    <?php endforeach; ?>
</ul>