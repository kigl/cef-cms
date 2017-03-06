<?php
use app\core\helpers\Breadcrumbs;
use app\modules\shop\models\Group;
$this->setPageHeader(Yii::t('app', 'Create: {data}', ['data' => 'продукт']));
$this->params['breadcrumbs'] = $data['breadcrumbs'];

?>

<?= $this->render('_form', ['data' => $data]);?>