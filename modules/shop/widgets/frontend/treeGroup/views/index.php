<?php
use yii\widgets\Menu;
use app\modules\shop\widgets\frontend\treeGroup\asset\Asset;

Asset::register($this);
?>

<div class="panel panel-default">
    <div class="panel-heading">
        Группы
    </div>
    <div class="panel-body">
        <?= Menu::widget([
            'items' => $data,
            'activateParents' => true,
            'options' => $options,
            'submenuTemplate' => "\n<ul class='nav nav-pills nav-stacked'>\n{items}\n</ul>\n"
        ])?>
    </div>
</div>
