<?php

use app\components\helpers\Breadcrumbs;
use app\modules\shop\models\Group;

$this->params['breadcrumbs'] = Breadcrumbs::getLinksGroup(
    $group_id,
    [
        'route' => 'group/manager',
    ],
    Group::className());
?>

<?= $this->render('_form', ['model' => $model]);?>