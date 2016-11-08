<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 02.11.2016
 * Time: 20:52
 */

namespace app\modules\shop\models;

use yii\base\Model;
use yii\web\UploadedFile;
use app\core\service\ModelServiceInterface;

class ProductService implements ModelServiceInterface
{
    protected $model;
    protected $image;
    protected $property;
    protected $relation;
    protected $post;

    public function __construct(Product $model)
    {
        $this->model = $model;

        $this->init();
    }
    
    protected function init()
    {
        $this->property = $this->initProperty();
        $this->relation = $this->initRelation();
        $this->image = $this->initImage();
    }

    /**
     * @param Product $model
     * @return mixed
     */
    protected function initProperty()
    {
        $property = $this->model->getProductProperty()->with('property')->indexBy('property_id')->all();
        $allProperty = Property::find()->indexBy('id')->all();

        foreach (array_diff_key($allProperty, $property) as $pr) {
            $property[$pr->id] = new ProductProperty();
            $property[$pr->id]->property_id = $pr->id;
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

    public function load(array $post)
    {
        $this->post = $post;

        $result = $this->model->load($post);

        Model::loadMultiple($this->property, $post);
        Model::loadMultiple($this->image, $post);
        $this->relation->load($post);

        return $result;
    }

    public function validate()
    {
        return $this->model->validate();
    }
    
    public function save()
    {
        $this->model->save(false);
        $this->saveProperty();
        $this->saveRelation();
        $this->uploadImage();
        $this->processImage();
        
    }

    protected function saveProperty()
    {
        foreach ($this->property as $property) {
            $property->product_id = $this->model->id;

            if (isset($property->value) and $property->validate()) {
                $property->save(false);
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

    public function uploadImage($attribute = 'imageUpload')
    {
        $uploadedImages = UploadedFile::getInstances($this->model, $attribute);

        $c = 0;
        foreach ($uploadedImages as $upload) {
            $c++;
            $image = new Image();
            $image->product_id = $this->model->id;
            $image->name = $upload;
            // Ставит статус главной 1 картинки, если нет загруженных картинок
            if (!$this->image and $c == 1) {
                $image->status = Image::STATUS_MAIN;
            }
            $image->save(false);
        }
    }

    protected function initImage()
    {
        $images = $this->model->getImages()->indexBy('id')->all();

        return $images;
    }

    protected function processImage()
    {
        $imageStatus = (isset($this->post[Image::POST_STATUS_NAME]))? $this->post[Image::POST_STATUS_NAME] : null;

        if (is_array($this->image)) {
            foreach ($this->image as $image) {
                if (!empty($image->deleteKey)) {
                    $image->delete();
                } else {
                    $image->status = ($imageStatus == $image->id)? Image::STATUS_MAIN : null;
                    $image->save();
                }
            }
        }
        /*
         * @todo
         * Добавить логику присвоение статуса главной картинки
         */
    }

    public function setGroupId($groupId)
    {
        $this->model->group_id = (int)$groupId;
    }

    public function getData()
    {
        return [
            'model' => $this->model,
            'property' => $this->property,
            'relation' => $this->relation,
            'images' => $this->image,
        ];
    }

    public function getModel()
    {
        return $this->model;
    }
}