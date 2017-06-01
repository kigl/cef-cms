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
use app\modules\shop\Module;

class CurrencyModelService extends ShopModelService
{
    private $_model;

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
        $this->_model = new Currency();

        $this->setData([
            'model' => $this->_model,
            'breadcrumbs' => $this->getBreadcrumbs(),
        ]);

        return $this->save();
    }

    public function update()
    {
        $this->_model = Currency::findOne($this->data['get']['id']);

        if (!$this->_model) {
            throw new HttpException(500);
        }

        $this->setData([
            'model' => $this->_model,
            'breadcrumbs' => $this->getBreadcrumbs(null, $this->_model->name),
        ]);

        return $this->save();
    }

    private function load()
    {
        return $this->_model->load($this->getData('post'));
    }

    private function save()
    {
        if ($this->load()) {
            return $this->_model->save();
        }

        return false;
    }

    protected function getBreadcrumbs(Model $shop = null, $data = null)
    {
        $items = parent::getBreadcrumbs($shop, null);

        $items[] = ['label' => Module::t('Currencies'), 'url' => ['manager']];

        if ($data) {
            $items[] = ['label' => $data];
        }

        return $items;
    }
}