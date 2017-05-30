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
        $model = new Measure();

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
        $model = Measure::findOne($this->getData('get', 'id'));

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
        $breadcrumbs = parent::getBreadcrumbs();

        $breadcrumbs[] = ['label' => Module::t('Measure'), 'url' => ['manager']];

        if ($data) {
            $breadcrumbs[] = ['label' => $data];
        }

        return $breadcrumbs;
    }
}