<?php
use mihaildev\elfinder\InputFile;
use mihaildev\elfinder\ElFinder;
use yii\web\JsExpression;

echo InputFile::widget([
'language'   => 'ru',
'controller' => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
'filter'     => 'image',    // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#wiki-onlyMimes
'name'       => 'myinput',
'value'      => '',
]);

echo ElFinder::widget([
'language'         => 'ru',
'controller'       => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
//'filter'           => 'image',    // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#wiki-onlyMimes
'callbackFunction' => new JsExpression('function(file, id){}') // id - id виджета
]);