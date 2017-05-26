<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 02.11.2016
 * Time: 20:52
 */

namespace app\modules\shop\service\backend;


use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\HttpException;
use yii\web\UploadedFile;
use app\modules\shop\models\backend\Shop;
use app\modules\shop\models\backend\Product;
use app\modules\shop\models\backend\Image;
use app\modules\shop\models\backend\Property;
use app\modules\shop\models\backend\ProductProperty;

class ProductModelService extends ModelService
{
    /**
     * @var Product
     */
    protected $model;
    /**
     * @var array
     */
    protected $images;
    /**
     * @var array
     */
    protected $productProperties;

    protected $properties;

    public function create()
    {
        $shop = Shop::findOne(['id' => $this->data['get']['shop_id']]);

        if (!$shop) {
            throw new HttpException(500, 'No shop model');
        }

        $this->model = new Product([
            'shop_id' => $shop->id,
            'group_id' => $this->getData('get', 'group_id'),
            'parent_id' => $this->getData('get', 'parent_id'),
        ]);

        $this->initialization();

        $this->setData([
            'model' => $this->model,
            'properties' => $this->properties,
            'productProperties' => $this->productProperties,
            'breadcrumbs' => $this->getBreadcrumbs($shop, $this->model->group_id),
        ]);

        if ($this->load()) {

            return $this->save();
        }

        return false;
    }

    public function update()
    {
        $this->model = Product::find()
            ->with('shop')
            ->where(['id' => $this->getData('get', 'id')])
            ->one();

        if (!$this->model || !$this->model->shop) {
            throw new HttpException(500, 'No model');
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $this->model->getProductModifications(),
        ]);

        $this->initialization();

        $this->setData([
            'model' => $this->model,
            'properties' => $this->properties,
            'productProperties' => $this->productProperties,
            'dataProvider' => $dataProvider,
            'breadcrumbs' => $this->getBreadcrumbs(
                $this->model->shop,
                $this->model->group_id,
                $this->model->name,
                $this->model->parent_id),
        ]);

        if ($this->load()) {
            return $this->save();
        }

        return false;
    }

    public function delete($id)
    {
        $model = Product::find()
            ->where(['id' => $id])
            ->with(['productModifications', 'images'])
            ->one();

        $success = false;

        if ($model && ($success = $model->delete())) {

            foreach ($model->images as $image) {
                $image->delete();
            }

            foreach ($model->productModifications as $product) {
                $this->actionDelete($product->id);
            }

            $this->setData([
                'model' => $model,
            ]);
        }

        return $success;
    }

    protected function initialization()
    {
        $this->initProperties();
        $this->initImages();
    }

    /**
     * @return mixed
     */
    protected function initProperties()
    {
        $this->productProperties = $this->model->getProperties()
            ->all();

        $this->properties = Property::find()
            ->indexBy('id')
            ->all();


        foreach (array_diff_key($this->properties, $this->productProperties) as $pr) {
            $this->productProperties[$pr->id] = new ProductProperty();
            $this->productProperties[$pr->id]->property_id = $pr->id;
        }

        foreach ($this->properties as $property) {
            $this->productProperties[$property->id]->requiredValue = $property->required;
        }
    }

    /**
     * @param array $post
     * @return boolean
     */
    protected function load()
    {
        $post = $this->getData('post');

        $result = $this->model->load($post);

        Model::loadMultiple($this->productProperties, $post);
        Model::loadMultiple($this->images, $post);

        return $result;
    }

    protected function validate($validate = true)
    {

        if ($this->validateProperties($validate) && $this->model->validate($validate)) {
            return true;
        }

        return false;
    }

    protected function save($validate = true)
    {
        if ($this->validate($validate)) {
            $this->model->save($validate);
            $this->saveProperties();
            $this->uploadImages();
            $this->processImages();

            return true;
        }

        return false;
    }

    protected function validateProperties($validate = true)
    {
        $success = true;

        if ($validate) {

            foreach ($this->productProperties as $key => $property) {
                $property->validate();
                if (!$property->validate()) {

                    $success = false;
                }
            }
        }

        return $success;
    }


    protected function saveProperties($validate = true)
    {
        $success = true;

        if ($validate) {
            $success = $this->validateProperties();
        }

        foreach ($this->productProperties as $property) {
            $property->product_id = $this->model->id;

            if ($success === true) {
                if ($property->value !== '') {
                    $property->save();
                } else {
                    $property->delete();
                }
            }
        }

        return $success;
    }

    protected function initImages()
    {
        $this->images = $this->model->getImages()
            ->indexBy('id')
            ->all();
    }

    protected function uploadImages($attribute = 'imageUpload')
    {
        $uploadedImages = UploadedFile::getInstances($this->model, $attribute);

        foreach ($uploadedImages as $upload) {
            $image = new Image([
                'product_id' => $this->model->id,
                'name' => $upload
            ]);
            $image->save();

            $this->images[$image->id] = $image;
        }
    }

    protected function processImages()
    {
        $imageStatus = ArrayHelper::getValue($this->getData('post'), Image::POST_NAME_STATUS);

        if (is_array($this->images)) {

            foreach ($this->images as $key => $image) {

                if ($image->deleteKey) {
                    echo $image->deleteKey;
                    if ($image->delete()) {
                        unset($this->images[$key]);
                    }
                } else {
                    $image->status = ((int)$imageStatus === $image->id) ? Image::STATUS_MAIN : Image::STATUS_DEFAULT;
                    $image->save(false);
                }
            }

        }

        // проверим и установим статус
        $this->setStatusImage();
    }

    /**
     * Устанавливает статус основного изображения, если он не установлен
     */
    protected function setStatusImage()
    {
        $success = false;
        foreach ($this->images as $img) {
            if ($img->status === Image::STATUS_MAIN) {
                $success = true;
            }
        }

        if ($success === false && $this->images) {
            $image = reset($this->images);
            $image->status = Image::STATUS_MAIN;
            $image->save(false);
        }
    }
}