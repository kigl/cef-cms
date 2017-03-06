<?php
/**
 * Class GroupModelService
 * @package app\modules\shop\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\service\backend;


use app\core\traits\Breadcrumbs;
use Yii;
use app\core\service\ModelService;
use app\modules\shop\models\Group;
use app\modules\shop\models\GroupSearch;
use app\modules\shop\models\ProductSearch;

class GroupModelService extends ModelService
{
    use Breadcrumbs;

    public function actionManager()
    {
        $dataProviderSearch = new GroupSearch();
        $dataProviderGroup = $dataProviderSearch->search($this->getData('get'));
        $dataProviderProductSearch = new ProductSearch();
        $dataProviderProduct = $dataProviderProductSearch->search($this->getData('get'));

        $this->setData([
            'id' => $this->getData('get', 'id'),
            'dataProviderGroup' => $dataProviderGroup,
            'dataProviderProduct' => $dataProviderProduct,
            'breadcrumbs' => $this->buildGroupBreadcrumbs($this->getData('get', 'id')),
        ]);
    }

    public function actionCreate()
    {
        $model = new Group;
        $model->parent_id = $this->getData('get', 'parent_id');

        if ($model->load($this->getData('post')) and $model->save()) {

            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'model' => $model,
            'breadcrumbs' => $this->buildGroupBreadcrumbs($this->getData('get', 'parent_id')),
        ]);
    }

    public function actionUpdate()
    {
        $model = Group::findOne($this->getData('get', 'id'));

        if ($model->load($this->getData('post')) and $model->save()) {

            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'model' => $model,
            'breadcrumbs' => $this->buildGroupBreadcrumbs($this->getData('get', 'id')),
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

    protected function buildGroupBreadcrumbs($groupId)
    {
        $breadcrumbs = $this->buildBreadcrumbs([
            'group' => [
                'id' => $groupId,
                'modelClass' => Group::class,
                //'enableRoot' => true,
                'urlOptions' => [
                    'route' => '/backend/shop/group/manager',
                    'params' => ['id',],
                ],
            ],
        ]);

        return $breadcrumbs;
    }
}
