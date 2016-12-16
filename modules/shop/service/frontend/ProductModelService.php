<?php
/**
 * Class ProductService
 * @package app\modules\shop\models\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\service\frontend;

use Yii;
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
}