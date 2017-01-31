<?php
/**
 * Class GroupModelService
 * @package app\modules\shop\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\service\backend;


use Yii;
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
        ]);
    }

    public function actionDelete($id)
    {
        $model = Group::find()
            ->where([Group::tableName() . '.id' => $id])
            ->with(['products', 'subGroups'])
            ->one();

        if ($model && $model->delete()) {

            foreach ($model->products as $product) {
                Yii::createObject(ProductModelService::class)->actionDelete($product->id);
            }

            $this->setExecutedAction(self::EXECUTED_ACTION_DELETE);

            // рекурсивно удаляем вложенные группы
            foreach ($model->subGroups as $group) {
                $this->actionDelete($group->id);
            }

            $this->setData([
                'model' => $model,
            ]);
        }
    }
}
