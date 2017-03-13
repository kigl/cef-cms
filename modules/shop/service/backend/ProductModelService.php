<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 02.11.2016
 * Time: 20:52
 */

namespace app\modules\shop\service\backend;


use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use app\modules\shop\Module;
use app\core\traits\Breadcrumbs;
use app\core\service\ModelService;
use app\modules\shop\models\Product;
use app\modules\shop\models\Image;
use app\modules\shop\models\Property;
use app\modules\shop\models\ProductProperty;
use app\modules\shop\models\Group;

class ProductModelService extends ModelService
{
    use Breadcrumbs;
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
    protected $properties;

    public function actionCreate()
    {
        $this->model = new Product();
        $this->model->group_id = $this->getData('get', 'group_id');
        $this->model->parent_id = $this->getData('get', 'parent_id');

        $dataProvider = new ActiveDataProvider([
            'query' => $this->model->getSubProducts(),
        ]);

        $this->initialization();

        if ($this->load() && $this->save()) {

            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'model' => $this->model,
            'properties' => $this->properties,
            'dataProvider' => $dataProvider,
            'breadcrumbs' => $this->getItemBreadcrumbs($this->model->group_id),
        ]);
    }

    public function actionUpdate()
    {
        $this->model = Product::find()
            ->where(['id' => $this->getData('get', 'id')])
            ->one();

        $dataProvider = new ActiveDataProvider([
            'query' => $this->model->getSubProducts(),
        ]);

        $this->initialization();

        if ($this->load() and $this->save()) {
            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'model' => $this->model,
            'properties' => $this->properties,
            'dataProvider' => $dataProvider,
            'breadcrumbs' => $this->getItemBreadcrumbs($this->model->group_id),
        ]);
    }

    public function actionDelete($id)
    {
        $model = Product::find()
            ->where(['id' => $id])
            ->with(['subProducts', 'images'])
            ->one();

        $success = false;

        if ($model && ($success = $model->delete())) {

            foreach ($model->images as $image) {
                $image->delete();
            }

            foreach ($model->subProducts as $product) {
                $this->actionDelete($product->id);
            }

            $this->setData([
                'model' => $model,
            ]);
        }

        return $success;
    }

    public function initialization()
    {
        $this->initProperties();
        $this->initImages();
    }

    /**
     * @return mixed
     */
    protected function initProperties()
    {
        $this->properties = $this->model->getProperties()
            ->with('property')
            ->all();


        $allProperty = Property::find()
            ->indexBy('id')
            ->all();


        foreach (array_diff_key($allProperty, $this->properties) as $pr) {
            $this->properties[$pr->id] = new ProductProperty();
            $this->properties[$pr->id]->property_id = $pr->id;
        }

        foreach ($allProperty as $property) {
            $this->properties[$property->id]->requiredValue = $property->required;
        }
    }

    /**
     * @param array $post
     * @return boolean
     */
    public function load()
    {
        $post = $this->getData('post');

        $result = $this->model->load($post);

        Model::loadMultiple($this->properties, $post);
        Model::loadMultiple($this->images, $post);

        return $result;
    }

    protected function validate()
    {

        if ($this->validateProperties() && $this->model->validate()) {
            return true;
        }

        return false;
    }

    public function save()
    {
        if ($this->validate()) {
            $this->model->save();
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

            foreach ($this->properties as $key => $property) {
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

        foreach ($this->properties as $property) {
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

    public function uploadImages($attribute = 'imageUpload')
    {
        $uploadedImages = UploadedFile::getInstances($this->model, $attribute);

        foreach ($uploadedImages as $upload) {
            $image = new Image();
            $image->product_id = $this->model->id;
            $image->name = $upload;
            $image->save(false);

            $this->images[$image->id] = $image;
        }
    }

    protected function processImages()
    {
        $imageStatus = ArrayHelper::getValue($this->getData('post'), Image::POST_NAME_STATUS);

        if (is_array($this->images)) {
            $images = $this->images;
            foreach ($this->images as $key => $image) {
                $images[$key] = $image;

                if (!empty($image->deleteKey)) {
                    if ($image->delete()) {
                        unset($images[$key]);
                    }
                } else {
                    $image->status = ((int)$imageStatus === $image->id) ? Image::STATUS_MAIN : Image::STATUS_DEFAULT;
                    $image->save();
                }
            }
            $this->images = $images;
        }

        // проверим и установим статус
        $this->setStatusImage();
    }

    /**
     * Устанавливает статус основного изображения, если он не установлен
     */
    private function setStatusImage()
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

    protected function getItemBreadcrumbs($groupId)
    {
        $breadcrumbs = $this->buildBreadcrumbs([
            'items' => [
                'id' => $groupId,
                'modelClass' => Group::class,
                //'enableRoot' => true,
                'urlOptions' => [
                    'route' => '/backend/shop/group/manager',
                    'params' => ['id',],
                ],
            ],
        ]);

        array_unshift($breadcrumbs, ['label' => Module::t('Products'), 'url' => ['group/manager']]);

        return $breadcrumbs;
    }
}