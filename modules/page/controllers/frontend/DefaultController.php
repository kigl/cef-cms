<?php

/**
 * Class DefaultController
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */

namespace app\modules\page\controllers\frontend;

class DefaultController extends \app\modules\page\components\FrontendController
{
    public function actionView()
    {
        die('Сделать представление');
    }
}