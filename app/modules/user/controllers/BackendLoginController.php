<?php
/**
 * Class BackendLoginController
 * @package kigl\cef\module\user\controllers
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\user\controllers;


use Yii;
use app\modules\user\models\backend\service\UserModelService;
use app\core\web\Controller;

class BackendLoginController extends Controller
{
    public $layout = '@app/modules/backend/views/layouts/index.php';

    public function actionIndex()
    {
        $modelService = Yii::createObject([
            'class' => UserModelService::className(),
            'data' => ['post' => Yii::$app->request->post()]
        ]);

        if ($modelService->actionLogin()) {
            return $this->goBack();
        }

        return $this->render('_form', ['data' => $modelService->getData()]);
    }
}