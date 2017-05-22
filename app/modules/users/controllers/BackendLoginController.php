<?php
/**
 * Class BackendLoginController
 * @package kigl\cef\module\user\controllers
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\users\controllers;


use Yii;
use yii\widgets\ActiveForm;
use app\core\web\Controller;
use app\modules\users\models\backend\forms\LoginForm;

class BackendLoginController extends Controller
{
    public $layout = '@app/modules/backend/views/layouts/index.php';

    public function actionIndex()
    {
        $form = new LoginForm();

        if ($form->load(Yii::$app->request->post())) {

            if (Yii::$app->request->isAjax) {

                return json_encode(ActiveForm::validate($form));
            } elseif ($form->validate()) {

                Yii::$app->user->login($form->getUser());
                return $this->goBack();
            }
        }

        return $this->render('_form', ['data' => ['form' => $form]]);
    }
}