<?php
/**
 * Class MeasureModelService
 * @package app\modules\shop\service
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\service\backend;


use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\shop\Module;
use app\modules\shop\models\backend\Measure;

class MeasureModelService extends ShopModelService
{
    private $_model;

    public function manager()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Measure::find()
                ->where(['site_id' => Yii::$app->site->getId()]),
        ]);

        $this->setData([
            'dataProvider' => $dataProvider,
            'breadcrumbs' => $this->getBreadcrumbs(),
        ]);
    }

    public function create()
    {
        $this->_model = new Measure();

        $this->setData([
            'model' => $this->_model,
            'breadcrumbs' => $this->getBreadcrumbs(),
        ]);

        return $this->save();
    }

    public function update()
    {
        $this->_model = Measure::findOne($this->getData('get', 'id'));

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
        $breadcrumbs = parent::getBreadcrumbs();

        $breadcrumbs[] = ['label' => Module::t('Measures'), 'url' => ['manager']];

        if ($data) {
            $breadcrumbs[] = ['label' => $data];
        }

        return $breadcrumbs;
    }
}