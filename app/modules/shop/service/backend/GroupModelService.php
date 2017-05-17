<?php
/**
 * Class GroupModelService
 * @package app\modules\shop\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\service\backend;


use app\modules\shop\models\backend\SearchModel;
use Yii;
use app\modules\shop\Module;
use app\core\traits\Breadcrumbs;
use app\core\service\ModelService;
use app\modules\shop\models\backend\Group;
use app\modules\shop\models\backend\GroupSearch;
use app\modules\shop\models\backend\ProductSearch;
use yii\data\ArrayDataProvider;

class GroupModelService extends ModelService
{
    use Breadcrumbs;

    public function actionManager()
    {
        $search = new SearchModel();

        $group = Group::find()
            ->where(['parent_id' => $this->getData('get', 'id')])
            ->asArray();

        $dataProvider = new ArrayDataProvider([
            'allModels' => $group->all(),
        ]);

        $this->setData([
            'id' => $this->getData('get', 'id'),
            'searchModel' => $search,
            'dataProvider' => $dataProvider,
            'breadcrumbs' => $this->getBreadcrumbsItem($this->getData('get', 'id')),
        ]);
    }

    public function actionCreate()
    {
        $model = new Group;
        $model->parent_id = $this->getData('get', 'parent_id');

        $this->setData([
            'model' => $model,
            'breadcrumbs' => $this->getBreadcrumbsItem($this->getData('get', 'parent_id')),
        ]);

        if ($model->load($this->getData('post')) and $model->save()) {

            return true;
        }

        return false;
    }

    public function actionUpdate()
    {
        $model = Group::findOne($this->getData('get', 'id'));

        $this->setData([
            'model' => $model,
            'breadcrumbs' => $this->getBreadcrumbsItem($this->getData('get', 'id')),
        ]);

        if ($model->load($this->getData('post')) and $model->save()) {

            return true;
        }

        return false;
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

            // рекурсивно удаляем вложенные группы
            foreach ($model->subGroups as $group) {
                $this->actionDelete($group->id);
            }

            $this->setData([
                'model' => $model,
            ]);

            return true;
        }

        return false;
    }

    protected function getBreadcrumbsItem($groupId)
    {
        $breadcrumbs = $this->buildBreadcrumbs([
            'items' => [
                'id' => $groupId,
                'modelClass' => Group::class,
                //'enableRoot' => true,
                'urlOptions' => [
                    'route' => 'backend-group/manager',
                    'params' => ['id',],
                ],
            ],
        ]);

        array_unshift($breadcrumbs, ['label' => Module::t('Products'), 'url' => ['backend-group/manager']]);

        return $breadcrumbs;
    }
}
