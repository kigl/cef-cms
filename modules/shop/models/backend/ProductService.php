<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 02.11.2016
 * Time: 20:52
 */

namespace app\modules\shop\models\backend;

use yii\base\Model;
use yii\web\UploadedFile;
use app\core\service\ModelService;
use app\modules\shop\models\Product;
use app\modules\shop\models\Image;
use app\modules\shop\models\Property;
use app\modules\shop\models\ProductProperty;
use app\modules\shop\models\ProductModification;

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
    protected $modification;
    /**
     * @var array
     */
    protected $post;

    public function create()
    {
        $this->model = new Product();

        $this->init();

        $this->setViewData([
            'model' => $this->model,
            'property' => $this->property,
            'modification' => $this->modification,
            'images' => $this->image,
            'group_id' => $this->getQuery('group_id'),
        ]);
    }

    public function update()
    {
        $this->model = Product::findOne($this->getQuery('id'));

        $this->init();

        $this->setViewData([
            'model' => $this->model,
            'property' => $this->property,
            'modification' => $this->modification,
            'images' => $this->image,
        ]);
    }

    protected function init()
    {
        $this->property = $this->initProperty();
        $this->modification = $this->initModification();
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
    protected function initModification()
    {
        $relation = $this->model->getParentProductModification()->one();

        if (!isset($relation)) {
            $relation = new ProductModification();
        }

        return $relation;
    }

    /**
     * @return mixed
     */
    public function getModification()
    {
        return $this->modification;
    }

    /**
     * @param array $post
     * @return boolean
     */
    public function load()
    {
        $post = $this->requestData;

        $result = $this->model->load($post);

        Model::loadMultiple($this->property, $post);
        Model::loadMultiple($this->image, $post);
        $this->modification->load($post);

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
            $success = $this->model->save() ? true : false;
            $this->saveProperty();
            $this->saveModification();
            $this->uploadImage();
            $this->processImage();

            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }

        return $success;
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

    protected function saveModification()
    {
        if (!empty($this->modification->product_id)) {
            $this->modification->product_modification_id = $this->model->id;
            $this->modification->save();
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
        $imageStatus = (isset($this->requestData[Image::POST_STATUS_NAME])) ? (int)$this->requestData[Image::POST_STATUS_NAME] : null;

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
}