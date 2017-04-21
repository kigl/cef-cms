<?php

/**
 * Class DefaultController
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */

namespace app\modules\page\controllers;

use app\modules\page\models\Page;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionView($id)
    {
        $model = Page::findOne($id);

        return $this->render('view', ['model' => $model]);
    }
}