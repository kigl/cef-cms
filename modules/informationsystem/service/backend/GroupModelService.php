<?php
/**
 * Class GroupModelService
 * @package app\modules\informationsystem\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\informationsystem\service\backend;


use yii\data\ActiveDataProvider;
use app\core\service\ModelService;
use app\modules\informationsystem\models\Group;
use app\modules\informationsystem\models\ItemSearch;

class GroupModelService extends ModelService
{
    public function actionManager()
    {
        $searchModel = new ItemSearch();
        $dataProvider = $searchModel->search($this->getData('get'));


        $groupDataProvider = new ActiveDataProvider([
            'query' => Group::find()
                ->parentId($this->getData('get', 'id'))
                ->informationsystemId($this->getData('get', 'informationsystem_id')),
        ]);

        $this->setData([
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'groupDataProvider' => $groupDataProvider,
            'informationSystemId' => $this->getData('get', 'informationsystem_id'),
            'id' => $this->getData('get', 'id'),
        ]);
    }

    public function actionCreate()
    {
        $model = new Group;
        $model->parent_id = $this->getData('get', 'parent_id');
        $model->informationsystem_id = $this->getData('get', 'informationsystem_id');

        if ($model->load($this->getData('post')) and $model->save()) {
            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'model' => $model,
        ]);
    }

    public function actionUpdate(array $params)
    {
        $model = Group::find()
            ->byId($params['get']['id'])
            ->one();

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
            ->byId($id)
            ->with(['subGroups', 'items'])
            ->one();

        if ($model && $model->delete()) {

            foreach ($model->items as $item) {
                $itemModelService = new ItemModelService();
                $itemModelService->actionDelete($item->id);
            }

            foreach ($model->subGroups as $group) {
                $this->actionDelete($group->id);
            }

            $this->setExecutedAction(self::EXECUTED_ACTION_DELETE);
        }

        $this->setData([
            'model' => $model,
        ]);
    }
}
