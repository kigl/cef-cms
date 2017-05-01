<?php
/**
 * Created by PhpStorm.
 * User: ARstudio
 * Date: 09.11.2016
 * Time: 12:49
 */

namespace app\core\service;

use Yii;
use yii\base\Component;
use yii\base\Exception;
use yii\web\HttpException;

abstract class ModelService extends Component implements ModelServiceInterface
{
    const ERROR_NOT_MODEL = 1;
    const ERROR_NOT_MODEL_ALIAS = 2;

    const EXECUTED_ACTION_VALIDATE = 1;
    const EXECUTED_ACTION_SAVE = 2;
    const EXECUTED_ACTION_DELETE = 3;

    public $data = [];

    protected $error;

    protected $executedActions = [];

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
        } elseif (($data !== null) and (!key_exists($data, $this->data[$name]))) {
            return false;
        }

        return true;
    }

    protected function setError($constError)
    {
        $this->error = $constError;
    }

    public function hasError($constError)
    {
        return $this->error === $constError ? true : false;
    }

    public function setExecutedAction($action)
    {
        $this->executedActions[] = $action;
    }

    public function hasExecutedAction($action)
    {
        return in_array($action, $this->executedActions);
    }
}