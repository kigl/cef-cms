<?php
/**
 * Class ProductController
 * @package app\modules\shop\controllers\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\controllers\frontend;

use app\core\actions\View;
use Yii;
use app\modules\shop\components\FrontendController;
use app\modules\shop\service\frontend\ProductModelService;
use app\modules\shop\service\frontend\ProductViewService;

class ProductController extends FrontendController
{
    public function actions()
    {
        return [
            'view' => [
                'class' => View::className(),
                'modelService' => ProductModelService::class,
                'viewService' => ProductViewService::class,
            ],
        ];
    }
}
