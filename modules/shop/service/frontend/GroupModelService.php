<?php
/**
 * Class GroupService
 * @package app\modules\shop\models\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\service\frontend;


use app\core\traits\Breadcrumbs;
use yii\data\ActiveDataProvider;
use app\core\service\ModelService;
use app\modules\shop\models\Group;

class GroupModelService extends ModelService
{
    use Breadcrumbs;

    public function actionView()
    {
        $model = Group::find();

        $model->where(['id' => $this->getData('get', 'id')])
            ->with('subGroups');

        $modelGroup = $model->one();

        if (!$modelGroup) {
            $this->setError(self::ERROR_NOT_MODEL);
            return;
        }

        $dataProviderProduct = new ActiveDataProvider([
            'query' => $modelGroup->getProducts()
                ->with('mainImage'),
            'sort' => [
                'defaultOrder' => [
                    'name' => SORT_ASC,
                ],
                'attributes' => ['id', 'name', 'price'],
            ],
        ]);

        $breadcrumbs = $this->buildBreadcrumb([
            'group' => [
                'id' => $modelGroup->id,
                'modelClass' => Group::class,
                'urlOptions' => [
                    'route' => '/shop/group/view',
                    'params' => ['id', 'alias'],
                ],
            ],
        ]);

        $this->setData([
            'model' => $modelGroup,
            'dataProvider' => $dataProviderProduct,
            'subGroups' => $modelGroup->subGroups,
            'breadcrumbs' => $breadcrumbs,
        ]);

        /**@todo
         * проверка на алиас
         */
        if (!$this->hasData('get', 'alias')) {
            $this->setError(self::ERROR_NOT_MODEL_ALIAS);
        } elseif ($modelGroup->alias !== $this->getData('get', 'alias')) {
            $this->setError(self::ERROR_NOT_MODEL_ALIAS);
        }
    }
}
