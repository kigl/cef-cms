<?php
/**
 * Class ManagerController
 * @package app\modules\informationsystem\controllers\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\informationsystem\controllers\frontend;

use app\modules\informationsystem\components\FrontendController;
use app\modules\informationsystem\models\Informationsystem;

class ManagerController extends FrontendController
{
    public function actionSystem()
    {
        $model = Informationsystem::find()->all();

        return $this->render('system', ['model' => $model]);
    }
}