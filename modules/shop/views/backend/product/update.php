<?php
use app\core\helpers\Breadcrumbs;
use app\modules\shop\models\Group;

$this->params['breadcrumbs'] = Breadcrumbs::getLinksGroup(
    $model->group_id,
    [
        'route' => 'group/manager',
    ],
    Group::className());
$this->params['breadcrumbs'][] = ['label' => $model->name];
?>

<?= $this->render('_form', [
    'model' => $model,
    'property' => $property,
    'relation' => $relation,
    'images' => $images,
]);?>