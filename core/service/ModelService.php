<?php
/**
 * Created by PhpStorm.
 * User: ARstudio
 * Date: 09.11.2016
 * Time: 12:49
 */

namespace app\core\service;

use yii\base\Model;

abstract class ModelService implements ModelServiceInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;

        $this->init();
    }

    protected function init()
    {}

    public function getModel()
    {
        return $this->model;
    }
    
    public function validate()
    {
        return $this->model->validate();
    }
}