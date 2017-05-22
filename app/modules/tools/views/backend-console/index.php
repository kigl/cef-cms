<?php
use app\modules\tools\Module;
use yii\helpers\Url;

$this->params['breadcrumbs'][] = ['label' => Module::t('Console'), 'url' => ['backend-console/index']];
$this->setPageHeader(Module::t('Console'));
?>
<iframe src="<?= Url::to(['/tools/backend-console/console']); ?>" frameborder="0" width="100%" height="500px"></iframe>