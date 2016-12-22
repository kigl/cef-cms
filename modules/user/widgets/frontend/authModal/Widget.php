<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 22.12.2016
 * Time: 21:02
 */

namespace app\modules\user\widgets\frontend\authModal;


class widget extends \yii\base\Widget
{
    public function run()
    {
        return $this->render('index');
    }
}