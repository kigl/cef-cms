<?php
/**
 * Class AjaxController
 * @package app\modules\shop\controllers\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\controllers\frontend;

use Yii;
use app\modules\shop\components\FrontendController;
use yii\filters\VerbFilter;

class CartController extends FrontendController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'add' => ['post'],
                ],
            ],
        ];
    }

    public function actionAdd()
    {
        $response = Yii::$app->response;
        $response->format = $response::FORMAT_JSON;

        $postData = Yii::$app->request->post();

        Yii::$app->cart->add($postData['productId'], $postData['count']);

        return true;
    }

    public function actionView()
    {
        return $this->render('index');
    }
}