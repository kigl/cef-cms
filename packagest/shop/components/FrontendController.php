<?php
/**
 * Created by PhpStorm.
 * User: ARstudio
 * Date: 11.11.2016
 * Time: 11:45
 */

namespace app\modules\shop\components;

use app\modules\frontend\components\Controller;

abstract class FrontendController extends Controller
{
    public $layout = '@app/modules/shop/views/frontend/layouts/index';
}