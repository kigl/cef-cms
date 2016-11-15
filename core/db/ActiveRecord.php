<?php

namespace app\core\db;

use Yii;
use app\core\session\Flash;

class ActiveRecord extends \yii\db\ActiveRecord
{
    public function init()
    {
        $this->on(self::EVENT_BEFORE_UPDATE, function ($event) {
            Yii::$app->session->setFlash(Flash::FLASH_SUCCESS, Yii::t('app', 'Updated element'));
        });

        $this->on(self::EVENT_BEFORE_INSERT, function ($event) {
            Yii::$app->session->setFlash(Flash::FLASH_SUCCESS, Yii::t('app', 'Created element'));
        });

        $this->on(self::EVENT_BEFORE_DELETE, function ($event) {
            Yii::$app->session->setFlash(Flash::FLASH_SUCCESS, Yii::t('app', 'Deleted element'));
        });

        parent::init();
    }
}
