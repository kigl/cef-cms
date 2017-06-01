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
use app\modules\shop\models\backend\Price;
use app\modules\shop\models\backend\PriceProduct;
use app\modules\shop\models\Warehouse;
use app\modules\shop\models\backend\WarehouseProduct;
use app\modules\shop\models\backend\Product;
use app\modules\shop\models\backend\Image;
use app\modules\shop\models\backend\Property;
use app\modules\shop\models\backend\PropertyProduct;

class ProductModelService extends GroupModelService
{
    /**
     * @var Product
     */
    protected $_model;
    /**
     * @var array
     */
    protected $_images;
    /**
     * @var array
     */
    protected $_productProperties;

    protected $_properties;

    protected $_warehouses;

    protected $_warehouseProduct;

    protected $_prices;

    protected $_priceProduct;

    public function create()
    {
        $shop = Shop::findOne(['id' => $this->data['get']['shop_id']]);

        if (!$shop) {
            throw new HttpException(500, 'No shop model');
        }

        $this->_model = new Product([
            'shop_id' => $shop->id,
            'group_id' => $this->getData('get', 'group_id'),
            'parent_id' => $this->getData('get', 'parent_id'),
        ]);

        $dataProviderPacking = new ActiveDataProvider([
            'query' => $this->_model->getPacking(),
        ]);

        $this->initialization();

        $this->setData([
            'model' => $this->_model,
            'shop' => $shop,
            'prices' => $this->_prices,
            'priceProduct' => $this->_priceProduct,
            'warehouses' => $this->_warehouses,
            'warehouseProduct' => $this->_warehouseProduct,
            'measureList' => $this->getMeasureList(),
            'properties' => $this->_properties,
            'productProperties' => $this->_productProperties,
            'dataProviderPacking' => $dataProviderPacking,
            'breadcrumbs' => $this->getBreadcrumbs($shop, $this->_model->group_id),
        ]);

        if ($this->load()) {

            return $this->save();
        }

        return false;
    }

    public function update()
    {
        $this->_model = Product::find()
            ->where(['id' => $this->getData('get', 'id')])
            ->one();

        if (!$this->_model || !$this->_model->shop) {
            throw new HttpException(500, 'No model');
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $this->_model->getProductModifications(),
        ]);

        $dataProviderPacking = new ActiveDataProvider([
            'query' => $this->_model->getPacking(),
        ]);

        $this->initialization();

        $this->setData([
            'model' => $this->_model,
            'shop' => $this->_model->shop,
            'prices' => $this->_prices,
            'priceProduct' => $this->_priceProduct,
            'warehouses' => $this->_warehouses,
            'warehouseProduct' => $this->_warehouseProduct,
            'measureList' => $this->getMeasureList(),
            'properties' => $this->_properties,
            'productProperties' => $this->_productProperties,
            'dataProvider' => $dataProvider,
            'dataProviderPacking' => $dataProviderPacking,
            'breadcrumbs' => $this->getBreadcrumbs(
                $this->_model->shop,
                $this->_model->group_id,
                $this->_model->parent_id,
                $this->_model->name),
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
                $this->delete($product->id);
            }

            $this->setData([
                'model' => $model,
            ]);
        }

        return $success;
    }

    private function initialization()
    {
        $this->initWarehouse();
        $this->initPrice();
        $this->initProperties();
        $this->initImages();
    }

    private function initProperties()
    {
        $this->_productProperties = $this->_model->getProperties()
            ->all();

        $this->_properties = Property::find()
            ->indexBy('id')
            ->all();


        foreach (array_diff_key($this->_properties, $this->_productProperties) as $pr) {
            $this->_productProperties[$pr->id] = new PropertyProduct();
            $this->_productProperties[$pr->id]->property_id = $pr->id;
        }

        foreach ($this->_properties as $property) {
            $this->_productProperties[$property->id]->requiredValue = $property->required;
        }
    }

    private function load()
    {
        $post = $this->getData('post');

        if ($result = $this->_model->load($post)) {
            $this->_model->imageUpload = UploadedFile::getInstances($this->_model, 'imageUpload');
        }

        Model::loadMultiple($this->_priceProduct, $post);
        Model::loadMultiple($this->_warehouseProduct, $post);
        Model::loadMultiple($this->_productProperties, $post);
        Model::loadMultiple($this->_images, $post);

        return $result;
    }

    private function validate($validate = true)
    {
        if ($this->validateProperties($validate) && $this->_model->validate($validate)) {
            return true;
        }

        return false;
    }

    private function save($validate = true)
    {
        /**
         * @todo
         * сделать транзакцию
         */
        if ($this->validate($validate)) {
            $this->_model->save($validate);
            $this->saveWarehouse();
            $this->savePrice();
            $this->saveProperties();
            $this->uploadImages();
            $this->processImages();

            return true;
        }

        return false;
    }

    private function validateProperties($validate = true)
    {
        $success = true;

        if ($validate) {

            foreach ($this->_productProperties as $key => $property) {
                $property->validate();
                if (!$property->validate()) {

                    $success = false;
                }
            }
        }

        return $success;
    }


    private function saveProperties($validate = true)
    {
        $success = true;

        if ($validate) {
            $success = $this->validateProperties();
        }

        foreach ($this->_productProperties as $property) {
            $property->product_id = $this->_model->id;

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

    private function initImages()
    {
        $this->_images = $this->_model->getImages()
            ->indexBy('id')
            ->all();
    }

    private function uploadImages($attribute = 'imageUpload')
    {
        $uploadedImages = UploadedFile::getInstances($this->_model, $attribute);

        foreach ($uploadedImages as $upload) {
            $image = new Image([
                'product_id' => $this->_model->id,
                'name' => $upload
            ]);
            $image->save();

            $this->_images[$image->id] = $image;
        }
    }

    private function processImages()
    {
        $imageStatus = ArrayHelper::getValue($this->getData('post'), Image::POST_NAME_STATUS);

        if (is_array($this->_images)) {

            foreach ($this->_images as $key => $image) {

                if ($image->deleteKey) {
                    if ($image->delete()) {
                        unset($this->_images[$key]);
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
    private function setStatusImage()
    {
        $success = false;
        foreach ($this->_images as $img) {
            if ($img->status === Image::STATUS_MAIN) {
                $success = true;
            }
        }

        if ($success === false && $this->_images) {
            $image = reset($this->_images);
            $image->status = Image::STATUS_MAIN;
            $image->save(false);
        }
    }

    private function initWarehouse()
    {
        $this->_warehouseProduct = $this->_model->getWarehouseProduct()
            ->indexBy('warehouse_id')
            ->all();

        $this->_warehouses = Warehouse::find()
            ->where(['shop_id' => $this->_model->shop_id])
            ->indexBy('id')
            ->all();

        foreach (array_diff_key($this->_warehouses, $this->_warehouseProduct) as $warehouse) {
            $this->_warehouseProduct[$warehouse->id] = new WarehouseProduct([
                'warehouse_id' => $warehouse->id,
                'product_id' => $this->_model->id,
            ]);
        }
    }

    private function saveWarehouse()
    {
        foreach ($this->_warehouseProduct as $warehouseProduct) {
            if ($warehouseProduct->value !== '') {
                $warehouseProduct->save();
            } else {
                $warehouseProduct->delete();
            }
        }
    }

    private function initPrice()
    {
        $this->_priceProduct = $this->_model->getPriceProduct()
            ->indexBy('price_id')
            ->all();

        $this->_prices = Price::find()
            ->where(['shop_id' => $this->_model->shop_id])
            ->indexBy('id')
            ->all();

        foreach (array_diff_key($this->_prices, $this->_priceProduct) as $price) {
            $this->_priceProduct[$price->id] = new PriceProduct([
                'price_id' => $price->id,
                'product_id' => $this->_model->id,
            ]);
        }
    }

    private function savePrice()
    {
        foreach ($this->_priceProduct as $priceProduct) {
            if ($priceProduct->value !== '') {
                $priceProduct->save();
            } else {
                $priceProduct->delete();
            }
        }
    }

    protected function getBreadcrumbs(Model $shop = null, $groupId = null, $productId = null, $data = null)
    {
        $breadcrumbs = parent::getBreadcrumbs($shop, $groupId);

        $products = $this->buildBreadcrumbs([
            'items' => [
                'id' => $productId,
                'modelClass' => Product::class,
                'urlOptions' => [
                    'route' => 'backend-product/update',
                    'params' => ['id',],
                ],
            ],
        ]);

        if ($products) {
            $breadcrumbs = array_merge($breadcrumbs, $products);
        }

        if ($data) {
            $breadcrumbs[] = ['label' => $data];
        }

        return $breadcrumbs;
    }
}