<?php
/**
 * Class ProductService
 * @package app\modules\shop\models\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\service\frontend;

use Yii;
use yii\data\ActiveDataProvider;
use app\core\service\ModelService;
use app\modules\shop\models\Product;
use app\modules\shop\models\Group;
use yii\web\HttpException;

class ProductModelService extends ModelService
{
    /**
     * @todo $pageSize
     * @param int $pageSize
     */
    public function listProduct($pageSize = 3)
    {
        $model = Group::find();

        $model->where('id = :id', [':id' => $this->getRequestData('get', 'group_id')]);

        $modelGroup = $model->one();

        if (!$model->one()) {
            $this->setError(self::ERROR_NOT_MODEL);
            return;
        }

        $dataProviderProduct = new ActiveDataProvider([
            'query' => $modelGroup->getProducts()->with('mainImage'),
            'pagination' => [
                'pageSize' => $pageSize,
            ],
            'sort' => [
                'defaultOrder' => [
                    'name' => SORT_ASC,
                ],
                'attributes' => ['id', 'name', 'price'],
            ],
        ]);

        $this->setData([
            'model' => $modelGroup,
            'dataProvider' => $dataProviderProduct,
        ]);

        /**@todo
         * проверка на алиас
         */
        if (!$this->hasRequestData('get', 'alias')) {
            $this->setError(self::ERROR_NOT_MODEL_ALIAS);
        } elseif ($modelGroup->alias !== $this->getRequestData('get', 'alias')) {
            $this->setError(self::ERROR_NOT_MODEL_ALIAS);
        }
    }

    public function view()
    {
        $model = Product::find();

        $model->where('id = :id', [':id' => $this->getRequestData('get', 'id')]);

        $this->model = $model->with('group', 'images', 'mainImage', 'property.property')->one();

        if (!$model->one()) {
            $this->setError(self::ERROR_NOT_MODEL);
            return;
        }

        $this->setData([
            'model' => $this->model,
            'images' => $this->model->images,
            'property' => $this->model->property,
            'mainImage' => $this->model->mainImage,
            'group' => $this->model->group,
        ]);

        if (!$this->hasRequestData('get', 'alias')) {
            $this->setError(self::ERROR_NOT_MODEL_ALIAS);
        } elseif ($this->model->alias !== $this->getRequestData('get', 'alias')) {
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