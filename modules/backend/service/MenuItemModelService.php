<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 02.02.2017
 * Time: 20:20
 */

namespace app\modules\backend\service;


use app\core\service\ModelService;
use yii\data\ActiveDataProvider;
use app\modules\backend\models\MenuItem;

class MenuItemModelService extends ModelService
{
    public function actionManager(array $params)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => MenuItem::find(),
        ]);

        $this->setData([
            'dataProvider' => $dataProvider,
            'menuId' => $params['menu_id'],
            'parentId' => !empty($params['parent_id']) ? $params['parent_id'] : null,
        ]);
    }
}