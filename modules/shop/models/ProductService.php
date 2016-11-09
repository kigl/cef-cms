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
use app\core\service\ModelService;

class ProductService extends ModelService
{
    /**
     * @var Product
     */
    protected $model;
    /**
     * @var array
     */
    protected $image;
    /**
     * @var array
     */
    protected $property;
    /**
     * @var array
     */
    protected $relation;
    /**
     * @var array
     */
    protected $post;

    protected function init()
    {
        $this->property = $this->initProperty();
        $this->relation = $this->initRelation();
        $this->image = $this->initImage();
    }

    /**
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

    /**
     * @return array
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * @return ProductRelation
     */
    protected function initRelation()
    {
        $relation = $this->model->getParentProductRelation()->one();

        if (!isset($relation)) {
            $relation = new ProductRelation();
        }

        return $relation;
    }

    /**
     * @return mixed
     */
    public function getRelation()
    {
        return $this->relation;
    }

    /**
     * @param array $post
     * @return boolean
     */
    public function load(array $post)
    {
        $this->post = $post;

        $result = $this->model->load($post);

        Model::loadMultiple($this->property, $post);
        Model::loadMultiple($this->image, $post);
        $this->relation->load($post);

        return $result;
    }

    /**
     * @return boolean
     */
    public function validate()
    {
        return $this->model->validate();
    }

    public function save()
    {
        $transaction = Product::getDb()->beginTransaction();
        try {
            $this->model->save(false);
            $this->saveProperty();
            $this->saveRelation();
            $this->uploadImage();
            $this->processImage();

            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

    public function delete()
    {
        $success = $this->model->delete();
        $this->deleteImage();

        return $success;
    }

    protected function saveProperty()
    {
        foreach ($this->property as $property) {
            $property->product_id = $this->model->id;

            if (isset($property->value)) {
                $property->save();
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

    protected function initImage()
    {
        $images = $this->model->getImages()->indexBy('id')->all();

        return $images;
    }

    public function uploadImage($attribute = 'imageUpload')
    {
        $uploadedImages = UploadedFile::getInstances($this->model, $attribute);

        foreach ($uploadedImages as $upload) {
            $image = new Image();
            $image->product_id = $this->model->id;
            $image->name = $upload;
            $image->save(false);

            $this->image[$image->id] = $image;
        }
    }

    protected function processImage()
    {
        $imageStatus = (isset($this->post[Image::POST_STATUS_NAME])) ? (int)$this->post[Image::POST_STATUS_NAME] : null;

        if (is_array($this->image)) {
            $img = $this->image;
            foreach ($this->image as $key => $image) {
                $img[$key] = $image;
                if (!empty($image->deleteKey)) {
                    if ($image->delete()) {
                        unset($img[$key]);
                    }
                } else {
                    $image->status = ($imageStatus === $image->id) ? Image::STATUS_MAIN : Image::STATUS_DEFAULT;
                    $image->save();
                }
            }
            $this->image = $img;
        }

        // проверим и установим статус
        $this->setStatusImage();
    }

    /**
     * Устанавливает реклама статус, если он не установлен
     */
    private function setStatusImage()
    {
        $success = false;
        foreach ($this->image as $img) {
            if ($img->status === Image::STATUS_MAIN) {
                $success = true;
            }
        }

        if ($success === false and $this->image) {
            $image = reset($this->image);
            $image->status = Image::STATUS_MAIN;
            $image->save(false);
        }
    }

    private function deleteImage()
    {
        $modelImage = Image::findAll(['product_id' => $this->model->id]);

        foreach ($modelImage as $image) {
            $image->delete();
        }
    }

    /**
     * @param $groupId
     */
    public function setModelGroupId($groupId)
    {
        $this->model->group_id = (int)$groupId;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return [
            'model' => $this->model,
            'property' => $this->property,
            'relation' => $this->relation,
            'images' => $this->image,
        ];
    }
}