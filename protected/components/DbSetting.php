<?php
namespace app\components;

use Yii;
use yii\web\HttpException;

class DbSetting extends \yii\base\Object
{
    private $data = [];

    public function init()
    {
        parent::init();

        $db = $this->getDbConnection();

        $this->data = $db->createCommand('SELECT * FROM mn_setting')
            ->queryAll();
    }

    /**
     * @param  string $moduleId id модуля
     * @param  string $paramName имя настройки
     * @return string значение настройки
     */
    public function getValue($moduleId, $paramName)
    {
        return $this->getParams($moduleId, 'value', $paramName);
    }

    public function getLabel($moduleId, $paramName)
    {
        return $this->getParams($moduleId, 'label', $paramName);
    }

    public function getParams($moduleId, $key, $value)
    {
        $result = null;
        foreach ($this->getSettingModule($moduleId) as $data) {
            if (in_array($value, $data)) {
                $result = $data[$key];
            }
        }

        if ($result === null) {
            throw new HttpException('404', Yii::t('main', 'not param name'));
        }

        return $result;
    }

    public function getSettingModule($moduleId)
    {
        $setting = [];
        foreach ($this->data as $item) {
            if (in_array($moduleId, $item)) {
                $setting[] = $item;
            }
        }
        return $setting;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getDbConnection()
    {

        $db = Yii::$app->db;

        return $db;
    }
}