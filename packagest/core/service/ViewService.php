<?php
/**
 * Class ViewService
 * @package app\core\service
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace kigl\cef\core\service;

use Yii;
use yii\base\Exception;

abstract class ViewService implements ViewServiceInterface
{
    protected $data;

    public function setData(array $data)
    {
        $this->data = $data;

        return $this;
    }

    public function getData($data = null)
    {
        if ($data === null) {
            return $this->data;
        }

        if (key_exists($data, $this->data)) {
            return $this->data[$data];
        } else {
            throw new Exception(Yii::t('app', 'Not exist views: {views}', ['views' => $data]));
        }
    }
}