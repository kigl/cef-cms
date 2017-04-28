<?php
/**
 * Class GroupModelService
 * @package app\modules\infosystem\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystem\models\backend\service;


use app\modules\infosystem\models\Item;
use yii\data\ArrayDataProvider;
use yii\web\HttpException;
use app\modules\infosystem\Module;
use app\core\traits\Breadcrumbs;
use app\core\service\ModelService;
use app\modules\infosystem\models\backend\Infosystem;
use app\modules\infosystem\models\backend\Group;

class GroupModelService extends ModelService
{
    use Breadcrumbs;

    public function actionManager()
    {
        $infosystem = Infosystem::findOne($this->getData('get', 'infosystem_id'));

        $groups = Group::find()
            ->where(['parent_id' => $this->getData('get', 'id'), 'infosystem_id' => $this->getData('get', 'infosystem_id')])
            ->asArray()
            ->all();

        $items = Item::find()
            ->where(['group_id' => $this->getData('get', 'id'), 'infosystem_id' => $this->getData('get', 'infosystem_id')])
            ->asArray()
            ->all();

        $dataProvider = (new ArrayDataProvider([
            'allModels' => array_merge($groups, $items),
            'sort' => [
                'attributes' => ['name', 'date'],
            ],
        ]));

        $this->setData([
            'dataProvider' => $dataProvider,
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

        $this->setData([
            'model' => $model,
            'breadcrumbs' => $this->buildGroupBreadcrumbs($infosystem, $model->parent_id),
        ]);

        if ($model->load($this->getData('post')) && $model->save()) {

            return true;
        }

        return false;
    }

    public function actionUpdate()
    {
        $model = Group::find()
            ->byId($this->getData('get', 'id'))
            ->with('infosystem')
            ->one();

        if (!$model) {
            throw new HttpException(500);
        }

        $this->setData([
            'model' => $model,
            'breadcrumbs' => $this->buildGroupBreadcrumbs($model->infosystem, $model->id, $model->name),
        ]);

        if ($model->load($this->getData('post')) && $model->save()) {
            return true;
        }

        return false;
    }

    public function actionDelete($id)
    {
        $model = Group::find()
            ->byId($id)
            ->with(['subGroups', 'items'])
            ->one();

        if (!$model) {
            throw new HttpException(500);
        }

        $this->setData([
            'model' => $model,
        ]);

        if ($model && $model->delete()) {

            foreach ($model->items as $item) {
                $itemModelService = new ItemModelService();
                $itemModelService->actionDelete($item->id);
            }

            foreach ($model->subGroups as $group) {
                $this->actionDelete($group->id);
            }

            return true;
        }

        return false;
    }

    protected function buildGroupBreadcrumbs(Infosystem $infosystem, $groupId, $currentItemName = null)
    {
        $breadcrumbs = $this->buildBreadcrumbs([
            'items' => [
                'id' => $groupId,
                'modelClass' => \app\modules\infosystem\models\Group::className(),
                'urlOptions' => [
                    'route' => 'backend-group/manager',
                    'params' => ['id', 'infosystem_id'],
                ],
            ],
        ]);

        array_unshift(
            $breadcrumbs,
            ['label' => Module::t('Infosystems'), 'url' => ['backend-infosystem/manager']],
            ['label' => $infosystem->name, 'url' => ['backend-group/manager', 'infosystem_id' => $infosystem->id]]
        );

        return $breadcrumbs;
    }
}
