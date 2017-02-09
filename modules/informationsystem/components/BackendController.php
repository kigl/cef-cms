<?php
/**
 * Created by PhpStorm.
 * User: ARstudio
 * Date: 10.11.2016
 * Time: 17:53
 */

namespace app\modules\informationsystem\components;


use app\modules\backend\components\Controller;

abstract class BackendController extends Controller
{
    public $layout = '@app/modules/informationsystem/views/backend/layouts/index';
}