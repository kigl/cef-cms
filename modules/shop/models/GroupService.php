<?php
/**
 * Created by PhpStorm.
 * User: ARstudio
 * Date: 09.11.2016
 * Time: 12:48
 */

namespace app\modules\shop\models;


use app\core\service\ModelService;

class GroupService extends ModelService
{
    public function load(array $post)
    {
        // TODO: Implement load() method.
    }

    public function save()
    {
        // TODO: Implement save() method.
    }

    public function delete()
    {
        $success = $this->model->delete();
        if ($success) {
            $this->deleteProduct();
        }

        return $success;
    }

    protected function deleteProduct()
    {
        $product = Product::findAll(['group_id' => $this->model->id]);

        foreach ($product as $model) {
            $modelService = new ProductService($model);
            $modelService->delete();
        }
    }

    public function getData()
    {
        // TODO: Implement getData() method.
    }
}