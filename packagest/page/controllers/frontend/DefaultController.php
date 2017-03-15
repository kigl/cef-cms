<?php

/**
 * Class DefaultController
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */

namespace app\modules\page\controllers\frontend;

use app\modules\page\models\Page;

class DefaultController extends \app\modules\page\components\FrontendController
{
    public function actionView($id)
    {
        $model = Page::findOne($id);

        return $this->render('view', ['model' => $model]);
    }
}