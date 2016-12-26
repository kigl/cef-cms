<?php
/**
 * Class AjaxController
 * @package app\modules\shop\controllers\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\controllers\frontend;

use app\modules\shop\components\cart\actions\Add;
use app\modules\shop\components\FrontendController;


class CartController extends FrontendController
{

    public function actions()
    {
        return [
            'add' => [
                'class' => Add::className(),
            ],
        ];
    }

    public function actionView()
    {
        return $this->render('index');
    }
}