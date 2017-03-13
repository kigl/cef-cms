<?php

namespace app\core\db;

use Yii;
use kartik\alert\Alert;

class ActiveRecord extends \yii\db\ActiveRecord
{
    public function init()
    {
        $this->on(self::EVENT_BEFORE_UPDATE, function ($event) {
            Yii::$app->session->setFlash(Alert::TYPE_SUCCESS, Yii::t('app', 'Updated item'));
        });

        $this->on(self::EVENT_BEFORE_INSERT, function ($event) {
            Yii::$app->session->setFlash(Alert::TYPE_SUCCESS, Yii::t('app', 'Created item'));
        });

        $this->on(self::EVENT_BEFORE_DELETE, function ($event) {
            Yii::$app->session->setFlash(Alert::TYPE_SUCCESS, Yii::t('app', 'Deleted item'));
        });

        parent::init();
    }
}
