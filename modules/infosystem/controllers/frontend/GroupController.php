<?php
/**
 * Class ManagerController
 * @package app\modules\infosystem\controllers\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystem\controllers\frontend;


use Yii;
use app\modules\infosystem\components\FrontendController;

class GroupController extends FrontendController
{
    public function actionView($id)
    {
        echo $id;
    }
}