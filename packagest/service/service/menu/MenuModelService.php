<?php
/**
 * Class MenuModelService
 * @package app\modules\backend\service
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\service\service;


use app\core\service\ModelService;
use app\modules\service\models\menu\Menu;

class MenuModelService extends ModelService
{
    public function actionDelete($id)
    {
        $model = Menu::find()
            ->with('items')
            ->where(['id' => $id])
            ->one();

        if ($model && $model->delete()) {
            $this->setExecutedAction(self::EXECUTED_ACTION_DELETE);
        }

        $this->setData([
            'model' => $model,
        ]);
    }
}