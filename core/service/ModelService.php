<?php
/**
 * Created by PhpStorm.
 * User: ARstudio
 * Date: 09.11.2016
 * Time: 12:49
 */

namespace app\core\service;

use Yii;
use yii\base\Exception;
use yii\web\HttpException;

abstract class ModelService implements ModelServiceInterface
{
    protected $model;

    protected $requestData = [];

    protected $data = [];

    protected $viewData = [];

    public function load()
    {
        return $this->model->load($this->getData('post'));
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

    public function setRequestData(array $data)
    {
        $this->requestData = $data;
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
    public function getData($name = null)
    {
        if (isset($name) and (isset($this->data[$name]))) {
            return $this->data[$name];
        }
        return $this->data;
    }

    /**
     * @param $name
     * @param null $data
     * @return mixed
     * @throws Exception
     */
    public function getRequestData($name, $data = null)
    {
        if (!key_exists($name, $this->requestData)) {
            throw new Exception(Yii::t('app', 'Not exist views: {views}', ['views' => $name]));
        } elseif (($data !== null) and (!key_exists($data, $this->requestData[$name]))) {
            throw new Exception(Yii::t('app', 'Not exist views: {views}', ['views' => $data]));
        }

        return $data ? $this->requestData[$name][$data] : $this->requestData[$name];
    }

    public function hasRequestData($name, $data = null)
    {
        if (!key_exists($name, $this->requestData)) {
            return false;
        } elseif (($data !== null) and (!key_exists($data, $this->requestData[$name]))) {
            return false;
        }

        return true;
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