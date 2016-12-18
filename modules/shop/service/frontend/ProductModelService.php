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

class ProductModelService extends ModelService
{
    public function view()
    {
        $model = Product::find();

        if (Yii::$app->getModule('shop')->urlAlias) {
            $model->where('alias = :alias', [':alias' => $this->getRequestData('get', 'id')]);
        } else {
            $model->where('id = :id', [':id' => $this->getRequestData('get', 'id')]);
        }

        $this->model = $model->with('group', 'images', 'mainImage', 'property.property')->one();

        $this->setData([
            'model' => $this->model,
            'images' => $this->model->images,
            'property' => $this->model->property,
            'mainImage' => $this->model->mainImage,
            'group' => $this->model->group,
        ]);
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