<?php
/**
 * Class GroupModelService
 * @package app\modules\shop\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\service\backend;


use app\core\service\ModelService;
use app\modules\shop\models\Group;

class GroupModelService extends ModelService
{
    public function actionCreate(array $params)
    {
        $model = new Group;
        $model->parent_id = $params['parentId'];

        if ($model->load($params['post']) and $model->save()) {

            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'model' => $model,
            'parentId' => $model->parent_id,
        ]);
    }

    public function actionUpdate(array $params)
    {
        $model = Group::findOne($params['id']);

        if ($model->load($params['post']) and $model->save()) {

            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'model' => $model,
            'parentId' => $model->parent_id,
        ]);
    }

    public function actionDelete($id)
    {
        $model = Group::find()
            ->where(['id' => $id])
            ->with(['products'])
            ->one();

        if ($model->delete()) {

            foreach ($model->products as $product) {
                $productModelService = new ProductModelService();
                $productModelService->actionDelete($product->id);
            }

            $this->setExecutedAction(self::EXECUTED_ACTION_DELETE);
        }

        // рекурсивно удаляем вложенные группы
        $modelGroups = Group::findAll(['parent_id' => $model->id]);

        if ($modelGroups) {
            foreach ($modelGroups as $group) {
                $this->actionDelete($group->id);
            }
        }

        $this->setData([
            'parentId' => $model->parent_id,
        ]);
    }
}
