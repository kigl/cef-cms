<?php
/**
 * Class GroupModelService
 * @package app\modules\shop\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace kigl\cef\module\shop\service\backend;


use Yii;
use kigl\cef\module\shop\Module;
use kigl\cef\core\traits\Breadcrumbs;
use kigl\cef\core\service\ModelService;
use kigl\cef\module\shop\models\Group;
use kigl\cef\module\shop\models\GroupSearch;
use kigl\cef\module\shop\models\ProductSearch;

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
            'breadcrumbs' => $this->getBreadcrumbsItem($this->getData('get', 'id')),
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
            'breadcrumbs' => $this->getBreadcrumbsItem($this->getData('get', 'parent_id')),
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
            'breadcrumbs' => $this->getBreadcrumbsItem($this->getData('get', 'id')),
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

    protected function getBreadcrumbsItem($groupId)
    {
        $breadcrumbs = $this->buildBreadcrumbs([
            'items' => [
                'id' => $groupId,
                'modelClass' => Group::class,
                //'enableRoot' => true,
                'urlOptions' => [
                    'route' => '/backend/shop/group/manager',
                    'params' => ['id',],
                ],
            ],
        ]);

        array_unshift($breadcrumbs, ['label' => Module::t('Products'), 'url' => ['group/manager']]);

        return $breadcrumbs;
    }
}
