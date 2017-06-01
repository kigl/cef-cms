<?php
/**
 * Class CurrencyModelService
 * @package app\modules\shop\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\service\backend;


use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\web\HttpException;
use app\modules\shop\models\backend\Currency;

class CurrencyModelService extends ShopModelService
{
    public function manager()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Currency::find()
                ->where(['site_id' => Yii::$app->site->getId()])
        ]);

        $this->setData([
            'dataProvider' => $dataProvider,
            'breadcrumbs' => $this->getBreadcrumbs(),
        ]);
    }

    public function create()
    {
        $model = new Currency();

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
        $model = Currency::findOne($this->data['get']['id']);

        if (!$model) {
            throw new HttpException(500);
        }

        $this->setData([
            'model' => $model,
            'breadcrumbs' => $this->getBreadcrumbs(null, $model->name),
        ]);

        if ($model->load($this->getData('post'))) {
            return $model->save();
        }

        return false;
    }

    protected function getBreadcrumbs(Model $shop = null, $data = null)
    {
        $items = parent::getBreadcrumbs($shop, null);

        $items[] = ['label' => Yii::t('app', 'Currency'), 'url' => ['manager']];

        if ($data) {
            $items[] = ['label' => $data];
        }

        return $items;
    }
}