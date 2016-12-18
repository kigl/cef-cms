<?php
/**
 * Class GroupController
 * @package app\modules\shop\controllers\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\controllers\frontend;

use Yii;
use app\core\actions\View;
use app\modules\shop\components\FrontendController;
use app\modules\shop\service\frontend\GroupModelService;
use app\modules\shop\service\frontend\GroupViewService;
use app\modules\shop\models\Group;

class GroupController extends FrontendController
{
    //public $layout = '@app/modules/shop/views/frontend/layouts/column_2';

    public function actions()
    {
        return [
            'view' => [
                'class' => View::class,
                'modelService' => GroupModelService::class,
                'viewService' => GroupViewService::class,
            ],
        ];
    }
}