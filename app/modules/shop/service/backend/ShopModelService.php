<?php
/**
 * Class ShopModelService
 * @package app\modules\shop\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\service\backend;


use Yii;
use yii\data\ActiveDataProvider;
use app\modules\shop\models\backend\Shop;

class ShopModelService extends ModelService
{
    public function manager()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Shop::find()
                ->where(['site_id' => Yii::$app->site->getId()]),
        ]);

        $this->setData([
            'dataProvider' => $dataProvider,
            'breadcrumbs' => $this->getBreadcrumbs(),
        ]);

        return true;
    }

    public function create()
    {
        $model = new Shop();

        $this->setData([
            'model' => $model,
            'breadcrumbs' => $this->getBreadcrumbs(),
        ]);

        if ($model->load($this->getData('post'))) {

            return $model->save();
        }

        return false;
    }

    public function update()
    {
        $model = Shop::findOne($this->getData('get', 'id'));

        $this->setData([
            'model' => $model,
            'breadcrumbs' => $this->getBreadcrumbs(),
        ]);

        if ($model->load($this->getData('post'))) {

            return $model->save();
        }

        return false;
    }
}