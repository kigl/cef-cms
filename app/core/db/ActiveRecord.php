<?php

namespace app\core\db;

use Yii;

class ActiveRecord extends \yii\db\ActiveRecord
{
    public function init()
    {
        $this->on(self::EVENT_BEFORE_UPDATE, function ($event) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Updated element'));
        });

        $this->on(self::EVENT_BEFORE_INSERT, function ($event) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Created element'));
        });

        $this->on(self::EVENT_BEFORE_DELETE, function ($event) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Deleted element'));
        });

        parent::init();
    }
}
