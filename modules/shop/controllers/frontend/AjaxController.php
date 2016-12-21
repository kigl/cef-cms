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
use yii\web\CookieCollection;

class AjaxController extends FrontendController
{
    public function actionIndex()
    {
        $response = Yii::$app->response;
        $response->format = $response::FORMAT_RAW;

        // получаем куку
        $cookieName = 'toCart';
        $cookieRequest = Yii::$app->request->cookies;
        $cookieResponse = Yii::$app->response->cookies;

        // получаем данные из куки, если нет, получаем пустой массив
        $data = $cookieRequest->has($cookieName) ? json_decode($cookieRequest->get($cookieName)->value, true) : [];

        if (isset($_POST['toCart'])) {
            $post = $_POST['toCart'];
            $data[$post['productId']] = (int)$post['count'];
        }

        $cookieResponse->add(new Cookie([
            'name' => $cookieName,
            'value' => json_encode($data),
            'expire' => time()+3600*30,
        ]));

        return $cookieResponse->get($cookieName)->value;
    }

    public function actionTest()
    {
        if (isset($_POST['test'])) {
            $_POST['loop'] = 123;
            return 213;
        }
    }

    public function actionView()
    {
        return $this->render('index');
    }
}