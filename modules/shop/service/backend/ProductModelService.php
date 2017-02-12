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
use yii\web\UploadedFile;
use app\core\service\ModelService;
use app\modules\shop\models\Product;
use app\modules\shop\models\Image;
use app\modules\shop\models\Property;
use app\modules\shop\models\ProductProperty;

class ProductModelService extends ModelService
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
    protected $properties;

    public function actionCreate()
    {
        $this->model = new Product();
        $this->model->group_id = $this->getData('groupId');
        $this->model->parent_id = $this->getData('parentId');

        $dataProvider = new ActiveDataProvider([
            'query' => $this->model->getSubProducts(),
        ]);

        $this->init();

        if ($this->load() && $this->save()) {
            
            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'model' => $this->model,
            'properties' => $this->properties,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdate()
    {
        $this->model = Product::find()
            ->where(['id' => $this->getData('id')])
            ->one();

        $dataProvider = new ActiveDataProvider([
            'query' => $this->model->getSubProducts(),
        ]);

        $this->init();

        if ($this->load() and $this->save()) {
            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'model' => $this->model,
            'properties' => $this->properties,
            'dataProvider' => $dataProvider,
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

    protected function init()
    {
        $this->properties = $this->initProperties();
        $this->image = $this->initImage();
    }

    /**
     * @return mixed
     */
    protected function initProperties()
    {
        $property = $this->model->getProperties()
            ->with('property')
            ->indexBy('property_id')
            ->all();


        $allProperty = Property::find()
            ->indexBy('id')
            ->all();


        foreach (array_diff_key($allProperty, $property) as $pr) {
            $property[$pr->id] = new ProductProperty();
            $property[$pr->id]->property_id = $pr->id;
        }

        return $property;
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
        Model::loadMultiple($this->image, $post);

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
            $this->uploadImage();
            $this->processImage();

            return true;
        }

        return false;
    }

    protected function validateProperties($validate = true)
    {
        $success = true;
        if ($validate) {
            foreach ($this->properties as $property) {
                if ($property->property->required && $property->value === '') {
                    $property->addError(
                        'value',
                        Yii::t('yii', '{attribute} cannot be blank.', ['attribute' => Yii::t('shop', 'Properties')]));

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

    protected function initImage()
    {
        $images = $this->model->getImages()
            ->indexBy('id')
            ->all();

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
        $imageStatus = (isset($this->data['post'][Image::POST_STATUS_NAME]))
            ? (int)$this->data['post'][Image::POST_STATUS_NAME]
            : null;

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
}