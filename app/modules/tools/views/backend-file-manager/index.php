<?php
use app\modules\tools\Module;
use mihaildev\elfinder\ElFinder;

$this->params['breadcrumbs'][] = ['label' => Module::t('File manager'), 'url' => ['index']];
$this->setPageHeader(Module::t('File manager'));
?>

<?php
echo ElFinder::widget([
    'language' => 'ru',
    'controller' => 'elfinder',
    'frameOptions' => ['style' => 'width: 100%; height: 700px;  border: 0;'],
    'path' => 'image',
]); ?>

