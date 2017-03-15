<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 09.03.2017
 * Time: 19:53
 */

namespace kigl\cef\core\assets;


use yii\web\AssetBundle;

class FontAwesome extends AssetBundle
{
    public $sourcePath = '@vendor/fortawesome/font-awesome';

    public $publishOptions = [
        'only' => ['fonts/*', 'css/*'],
    ];

    public $css = [
        ['css/font-awesome.css'],
    ];
}