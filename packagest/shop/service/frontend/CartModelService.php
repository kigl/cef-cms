<?php
/**
 * Class CartModelService
 * @package app\modules\shop\service\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\service\frontend;


use Yii;
use app\core\service\ModelService;

class CartModelService extends ModelService
{
    public function actionIndex()
    {
        $this->setData([
            'cartService' => Yii::$app->cart,
        ]);
    }
}