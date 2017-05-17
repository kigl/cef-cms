<?php
/**
 * Class CartModelService
 * @package app\modules\shop\service\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace kigl\cef\module\shop\service;


use Yii;
use kigl\cef\core\service\ModelService;

class CartModelService extends ModelService
{
    public function actionIndex()
    {
        $this->setData([
            'cartService' => Yii::$app->cart,
        ]);
    }
}