<?php
/**
 * Class ProductService
 * @package app\modules\shop\models\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\models\frontend;


use app\core\service\ModelService;
use app\modules\shop\models\Product;

class ProductService extends ModelService
{
    public function view()
    {
        $model = Product::findOne($this->getQuery('id'));

        $this->setViewData([
           'model' => $model,
        ]);
    }
}