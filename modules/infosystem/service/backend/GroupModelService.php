<?php
/**
 * Class GroupModelService
 * @package app\modules\infosystem\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystem\service\backend;


use yii\data\ActiveDataProvider;
use app\core\traits\Breadcrumbs;
use app\modules\infosystem\models\Infosystem;
use app\core\service\ModelService;
use app\modules\infosystem\models\Group;
use app\modules\infosystem\models\ItemSearch;

class GroupModelService extends ModelService
{
    use Breadcrumbs;

    public function actionManager()
    {
        $searchModel = new ItemSearch();
        $dataProvider = $searchModel->search($this->getData('get'));
        $infosystem = Infosystem::findOne($this->getData('get', 'infosystem_id'));


        $groupDataProvider = new ActiveDataProvider([
            'query' => Group::find()
                ->parentId($this->getData('get', 'id'))
                ->infosystemId($this->getData('get', 'infosystem_id')),
        ]);

        $this->setData([
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'groupDataProvider' => $groupDataProvider,
            'infosystem' => $infosystem,
            'breadcrumbs' => $this->buildGroupBreadcrumbs($infosystem, $this->getData('get', 'id')),
            'id' => $this->getData('get', 'id'),
        ]);
    }

    public function actionCreate()
    {
        $model = new Group;
        $model->parent_id = $this->getData('get', 'parent_id');
        $model->infosystem_id = $this->getData('get', 'infosystem_id');
        $infosystem = Infosystem::findOne($this->getData('get', 'infosystem_id'));

        if ($model->load($this->getData('post')) and $model->save()) {
            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'model' => $model,
            'breadcrumbs' => $this->buildGroupBreadcrumbs($infosystem, $model->parent_id),
        ]);
    }

    public function actionUpdate()
    {
        $model = Group::find()
            ->byId($this->getData('get', 'id'))
            ->with('infosystem')
            ->one();

        if ($model->load($this->getData('post')) and $model->save()) {
            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'model' => $model,
            'breadcrumbs' => $this->buildGroupBreadcrumbs($model->infosystem, $model->id),
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

    protected function buildGroupBreadcrumbs(Infosystem $infosystem, $group_id)
    {
        $breadcrumbs = $this->buildBreadcrumbs([
            'group' => [
                'id' => $group_id,
                'modelClass' => Group::class,
                'urlOptions' => [
                    'route' => '/backend/infosystem/group/manager',
                    'params' => ['id', 'infosystem_id'],
                ],
            ],
        ]);

        array_unshift($breadcrumbs, ['label' => $infosystem->name, 'url' => ['manager', 'infosystem_id' => $infosystem->id]]);

        return $breadcrumbs;
    }
}
