<?php
/**
 * Class AjaxController
 * @package app\modules\shop\controllers\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\controllers\frontend;

use Faker\Test\Provider\ProviderOverrideTest;
use Yii;
use app\modules\shop\components\FrontendController;
use yii\helpers\ArrayHelper;
use yii\web\Cookie;

class AjaxController extends FrontendController
{
    public function actionIndex()
    {
        $response = Yii::$app->response;
        $response->format = $response::FORMAT_JSON;

        // получаем куку
        $cookieRequest = Yii::$app->request->cookies;
        $cookieResponse = Yii::$app->response->cookies;
        // создаем куку
        if (!$cookieRequest->get('toCart')) {
            $cookieResponse->add(new Cookie([
                'name' => 'toCart',
                'value' => json_encode($value = []),
                'expire' => time()+3600*30,
            ]));
        }

        $oldCookie = $cookieRequest->get('toCart');

        $dataFromCookie = json_decode($oldCookie->value);

        $keyArrayPost = key($_POST['toCart']);
        $valueArrayPost = $_POST['toCart'][$keyArrayPost];

        $dataFromCookie[$keyArrayPost] = $valueArrayPost;

        $newDataJson = json_encode($dataFromCookie);

        $cookieResponse->add(new Cookie([
            'name' => 'toCart',
            'value' => $newDataJson,
            'expire' => time()+3600*30,
        ]));

        print_r($cookieResponse->get('toCart')->value);


    }

    public function actionView()
    {
        return $this->render('view');
    }
}