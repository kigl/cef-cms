<?php
/**
 * Class MenuModelService
 * @package app\modules\backend\service
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace kigl\cef\module\menu\backend\models\service;


use kigl\cef\core\service\ModelService;
use kigl\cef\module\menu\models\backend\Menu;

class MenuModelService extends ModelService
{
    public function actionDelete($id)
    {
        $model = Menu::find()
            ->with('items')
            ->where(['id' => $id])
            ->one();

        $this->setData([
            'model' => $model,
        ]);

        if ($model && $success = $model->delete()) {

            return true;
        }

        return false;
    }
}