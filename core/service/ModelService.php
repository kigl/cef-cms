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

    protected $data = [];

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

    /**
     * @param array $data
     */
    public function setData(array $data)
    {
        foreach ($data as $key => $value) {
            $this->data[$key] = $value;
        }
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param $name
     * @param $data
     * @return mixed
     * @throws \HttpException
     */
    public function getRequestData($name, $data = null)
    {
        if (!isset($this->requestData[$name])) {
            throw new \HttpException(500);
        }

        return $data ? $this->requestData[$name][$data] : $this->requestData[$name];
    }

    /**
     * @return Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /*
    public function getFind()
    {
        $class = get_class($this->model);
        return $class::find();
    }
    */
}