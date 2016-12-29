<?php
/**
 * Class Widget
 * @package app\modules\shop\widgets\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\widgets\frontend\cart;


use Yii;

class Widget extends \yii\base\Widget
{
    public $urlPageCart = null;

    public function run()
    {
        $data = Yii::$app->cart;

        return $this->render('index', [
            'data' => $data,
            'urlPageCart' => $this->urlPageCart,
        ]);
    }
}