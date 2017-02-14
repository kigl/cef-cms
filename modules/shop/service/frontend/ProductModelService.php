<?php
/**
 * Class ProductService
 * @package app\modules\shop\models\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\service\frontend;


use yii\data\ActiveDataProvider;
use app\core\traits\Breadcrumbs;
use app\core\service\ModelService;
use app\modules\shop\models\Product;
use app\modules\shop\models\Group;
use yii\helpers\ArrayHelper;

class ProductModelService extends ModelService
{
    use Breadcrumbs;

    protected $model;

    public function view($id, $alias)
    {
        $model = Product::find();

        $model->where(['id' => $id]);

        $this->model = $model->with('group', 'subProducts.properties.property', 'images', 'mainImage', 'properties.property')
            ->one();

        if (!$this->model) {
            $this->setError(self::ERROR_NOT_MODEL);
            return;
        }

        $breadcrumbs = $this->buildBreadcrumb([
            'group' => [
                'id' => $this->model->group_id,
                'modelClass' => Group::class,
                'urlOptions' => [
                    'route' => '/shop/group/view',
                    'params' => ['id', 'alias'],
                ],
            ],
            'items' => [
                ['label' => $this->model->name],
            ],
        ]);

        $this->setData([
            'model' => $this->model,
            'images' => $this->model->images,
            'properties' => ArrayHelper::map($this->model->properties, 'name', 'value'),
            'mainImage' => $this->model->mainImage,
            'breadcrumbs' => $breadcrumbs,
        ]);

        if ($alias == '') {
            $this->setError(self::ERROR_NOT_MODEL_ALIAS);
        } elseif ($this->model->alias !== $alias) {
            $this->setError(self::ERROR_NOT_MODEL_ALIAS);
        }
    }

    public function search($pageSize = 3)
    {
        $model = Product::find()->with('mainImage');

        $dataProvider = new ActiveDataProvider([
            'query' => $model,
            'pagination' => [
                'pageSize' => $pageSize,
            ],
            'sort' => [
                'attributes' => ['id', 'name', 'price'],
            ],
        ]);

        if ($searchValue = $this->getData('get', 'value')) {
            $model->where(['like', 'name', $searchValue]);
        } else {
            /*@todo
             * не выводить товары
             */
            $model->where('id = null');
        }

        $this->setData([
            'dataProvider' => $dataProvider,
        ]);
    }
}