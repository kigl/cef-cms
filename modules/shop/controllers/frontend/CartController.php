<?php
/**
 * Class AjaxController
 * @package app\modules\shop\controllers\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\controllers\frontend;

use Yii;
use app\modules\shop\components\FrontendController;


class CartController extends FrontendController
{

    public function actionAdd()
    {
        if ($post = Yii::$app->request->post()) {
           Yii::$app->cart->add($post['productId'], $post['qty']);
        }
    }

    public function actionView()
    {
        return $this->render('index');
    }
}