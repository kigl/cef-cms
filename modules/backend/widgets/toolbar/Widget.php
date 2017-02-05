<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 03.02.2017
 * Time: 21:40
 */

namespace app\modules\backend\widgets\toolbar;


use Yii;

class Widget extends \yii\base\Widget
{
    protected $toolbarFileTemplate = 'toolbar.php';

    public $options = [];

    public function run()
    {
        return $this->render('index', [
            'data' => $this->getToolbarFileData(),
            'options' => $this->options,
        ]);
    }

    protected function getModuleConfigPath()
    {
        return Yii::$app
            ->controller
            ->module
            ->basePath . '/config';
    }

    protected function getToolbarFilePathUrl()
    {
        return $this->getModuleConfigPath() . '/' . $this->toolbarFileTemplate;
    }

    protected function getToolbarFileData()
    {
        if (is_file($this->getToolbarFilePathUrl())) {
            $data = include $this->getToolbarFilePathUrl();
            return $data;
        }

        return null;
    }
}