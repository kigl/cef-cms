<?php
/**
 * Class MenuModelService
 * @package app\modules\backend\service
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\menu\service\backend;


use Yii;
use app\core\service\ModelService;
use app\modules\menu\models\backend\Menu;

class MenuModelService extends ModelService
{
    public function delete($id)
    {
        $model = Menu::find()
            ->with('items')
            ->where(['id' => $id])
            ->one();


        if ($model->delete()) {

            foreach ($model->items as $item) {

                Yii::createObject(ItemModelService::className())->delete($item->id);
            }

            return true;
        }

        return false;
    }
}