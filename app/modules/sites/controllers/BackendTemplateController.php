<?php
/**
 * Class BackendThemeController
 * @package app\modules\site\controllers
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\sites\controllers;


use Yii;
use yii\data\ActiveDataProvider;
use app\modules\backend\actions\Create;
use app\modules\backend\actions\Update;
use app\modules\backend\controllers\Controller;
use app\modules\sites\models\backend\Template;

class BackendTemplateController extends Controller
{
    public function actionLayoutsList()
    {
        $themeComponent = Yii::$app->view->theme;

        if ($post = Yii::$app->request->post('depdrop_all_params')['template_id']) {

            if ($themeComponent->existTemplate($post)) {

                $result = [];
                foreach ($themeComponent->getLayouts($post, false) as $name => $path) {
                    $result[] = ['id' => $name, 'name' => $name];
                }

                echo json_encode(['output' => $result, 'selected' => '']);
                return;
            }
        }

        echo json_encode(['output' => '', 'selected' => '']);
    }
}