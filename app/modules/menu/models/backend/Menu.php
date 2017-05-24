<?php

namespace app\modules\menu\models\backend;


use Yii;

class Menu extends \app\modules\menu\models\Menu
{

    public function beforeSave($insert)
    {
        $this->site_id = Yii::$app->site->getId();

        return parent::beforeSave($insert);
    }
}
