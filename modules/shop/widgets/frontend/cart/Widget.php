<?php
/**
 * Class Widget
 * @package app\modules\shop\widgets\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\widgets\frontend\cart;


class Widget extends \yii\base\Widget
{
    public function run()
    {
        return $this->render('index', ['data' => rand(0, 40)]);
    }
}