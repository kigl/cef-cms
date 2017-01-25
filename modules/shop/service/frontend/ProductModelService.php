<?php
/**
 * Class ProductService
 * @package app\modules\shop\models\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\service\frontend;

use yii\data\ActiveDataProvider;
use app\core\service\ModelService;
use app\modules\shop\models\Product;

class ProductModelService extends ModelService
{
    protected $model;

    public function view($id, $alias)
    {
        $model = Product::find();

        $model->where(['id' => $id]);

        $this->model = $model->with('group', 'modification.product.property.property', 'images', 'mainImage', 'property.property')
            ->one();

        if (!$this->model) {
            $this->setError(self::ERROR_NOT_MODEL);
            return;
        }

        $this->setData([
            'model' => $this->model,
            'images' => $this->model->images,
            'property' => $this->model->property,
            'mainImage' => $this->model->mainImage,
            'group' => $this->model->group,
            'modification' => $this->model->modification,
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

        if ($searchValue = $this->getRequestData('get', 'value')) {
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