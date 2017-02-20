<?php
/**
 * Class ManagerController
 * @package app\modules\infosystem\controllers\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystem\controllers\frontend;

use app\modules\infosystem\components\FrontendController;
use app\modules\infosystem\models\Group;
use app\modules\infosystem\models\Infosystem;

class GroupController extends FrontendController
{
    public function actionView($id)
    {
        $model = Group::find()
            ->with('infosystem')
            ->where(['id' => $id])
            ->one();

        return $this->render($model->infosystem->template_group, ['model' => $model]);
    }
}