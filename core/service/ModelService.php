<?php
/**
 * Created by PhpStorm.
 * User: ARstudio
 * Date: 09.11.2016
 * Time: 12:49
 */

namespace app\core\service;

use yii\web\HttpException;

abstract class ModelService implements ModelServiceInterface
{
    protected $model;

    protected $requestData = [];

    protected $viewData = [];

    protected $query = [];

    public function load()
    {
        return $this->model->load($this->requestData);
    }

    public function validate()
    {
        return $this->model->validate();
    }

    public function save()
    {
        return $this->model->save();
    }

    public function delete()
    {
        return $this->model->delete();
    }

    public function setRequestData(array $request)
    {
        $this->requestData = $request;
    }

    public function setQuery(array $query)
    {
        $this->query = $query;
    }

    public function setViewData(array $data)
    {
        foreach ($data as $key => $value) {
            $this->viewData[$key] = $value;
        }
    }

    public function getViewData()
    {
        return $this->viewData;
    }

    public function getQuery($key)
    {
        if (!isset($this->query[$key])) {
            throw new HttpException(500);
        }

        return $this->query[$key];
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getFind()
    {
        $class = get_class($this->model);
        return $class::find();
    }
}