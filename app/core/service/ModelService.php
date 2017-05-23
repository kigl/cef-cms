<?php
/**
 * Created by PhpStorm.
 * User: ARstudio
 * Date: 09.11.2016
 * Time: 12:49
 */

namespace app\core\service;


use yii\base\Component;

abstract class ModelService extends Component implements ModelServiceInterface
{
    const ERROR_NOT_MODEL = 1;
    const ERROR_NOT_MODEL_ALIAS = 2;

    public $data = [];

    protected $_error;

    /**
     * @param array $data
     */
    public function setData(array $data)
    {
        foreach ($data as $key => $value) {
            $this->data[$key] = $value;
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getData($key = null, $value = null)
    {
        if (isset($value)) {
            if (isset($this->data[$key][$value])) {
                if ($this->data[$key][$value] === '') {
                    return null;
                }
                return $this->data[$key][$value];
            } else {
                return null;
            }
        }

        if (array_key_exists($key, $this->data)) {
            return $this->data[$key];
        } elseIf (isset($key)) {
            return null;
        }

        return $this->data;
    }

    public function hasData($name, $data = null)
    {
        if (!key_exists($name, $this->data)) {
            return false;
        } elseif (($data !== null) && (!key_exists($data, $this->data[$name]))) {
            return false;
        }

        return true;
    }

    protected function setError($constError)
    {
        $this->_error = $constError;
    }

    public function hasError($constError)
    {
        return $this->_error === $constError;
    }
}
