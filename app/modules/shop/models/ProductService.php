<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 02.11.2016
 * Time: 20:52
 */

namespace app\modules\shop\models;


use yii\base\Model;

class ProductService
{
    protected $model;
    protected $image;
    protected $property;
    protected $relation;

    public function __construct(Product $model)
    {
        $this->model = $model;

        $this->init();
    }
    
    protected function init()
    {
        $this->property = $this->initProperty();
        $this->relation = $this->initRelation();
    }

    /**
     * @param Product $model
     * @return mixed
     */
    protected function initProperty()
    {
        $property = $this->model->getProductProperty()->with('property')->indexBy('property_id')->all();
        $allProperty = Property::find()->indexBy('id')->all();

        foreach (array_diff_key($allProperty, $property) as $property) {
            $property[$property->id] = new Image();
            $property[$property->id]->property_id = $property->id;
        }

        return $property;
    }

    public function getProperty()
    {
        return $this->property;
    }

    protected function initRelation()
    {
        $relation = $this->model->getParentProductRelation()->one();

        if (!isset($relation)) {
            $relation = new ProductRelation();
        }

        return $relation;
    }

    public function getRelation()
    {
        return $this->relation;
    }

    public function loadData(array $post)
    {
        $this->model->load($post);
        Model::loadMultiple($this->property, $post);
        $this->relation->load($post);
    }

    public function modelValidete()
    {
        return $this->model->validate();
    }
    
    public function save()
    {
        $this->model->save(false);
        $this->saveProperty();
        $this->saveRelation();
        
    }

    protected function saveProperty()
    {
        foreach ($this->property as $property) {
            $property->product_id = $this->model->id;

            if (isset($property->value) and $property->validate()) {
                $property->save(false);
            } else {
                // $property->delete();
            }
        }
    }

    protected function saveRelation()
    {
        if (!empty($this->relation->product_id)) {
            $this->relation->product_relation_id = $this->model->id;
            $this->relation->save();
        }
    }

    public function getData()
    {
        return [
            'model' => $this->model,
            'property' => $this->property,
            'relation' => $this->relation,
        ];
    }
}