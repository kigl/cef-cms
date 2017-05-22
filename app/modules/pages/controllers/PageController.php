<?php

/**
 * Class DefaultController
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */

namespace app\modules\pages\controllers;


use app\modules\pages\models\Page;
use app\controllers\Controller;

class PageController extends Controller
{
    public function actionView($id)
    {
        $model = Page::findOne($id);

        return $this->render($model->template, ['model' => $model]);
    }
}