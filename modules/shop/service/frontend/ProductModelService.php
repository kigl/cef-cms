<?php
/**
 * Class ProductService
 * @package app\modules\shop\models\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\service\frontend;


use app\core\service\ModelService;
use app\modules\shop\models\Product;

class ProductModelService extends ModelService
{
    public function view()
    {
        $model = Product::findOne($this->getRequestData('get', 'id'));

        $this->setData([
           'model' => $model,
        ]);
    }
}