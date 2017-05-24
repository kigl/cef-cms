<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 20.02.2017
 * Time: 20:18
 */

namespace app\modules\infosystems\service;


use Yii;
use yii\data\ActiveDataProvider;
use app\modules\infosystems\models\Item;
use app\modules\infosystems\models\Infosystem;

class ItemModelService extends ModelService
{
    public function view()
    {
        $model = Item::find()
            ->alias('it')
            ->joinWith(['infosystem as inf'])
            ->where(['it.id' => $this->getData('get', 'id'), 'it.status' => Item::STATUS_ACTIVE])
            ->andWhere(['inf.site_id' => Yii::$app->site->getId()])
            ->one();

        if (!$model) {

            return false;
        }

        $model->updateCounters(['counter' => 1]);

        if ($this->getData('get', 'alias') != $model->alias) {

            $this->setError(self::ERROR_NOT_MODEL_ALIAS);
        }

        $this->setData([
            'model' => $model,
            'breadcrumbs' => $this->getItemsBreadcrumb($model->infosystem, $model->group_id, $model->name),
        ]);

        return true;
    }

    public function itemsTag()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Item::find()
                ->joinWith(['tags as tag'], true)
                ->with('properties')
                ->where(['tag.name' => $this->getData('get', 'name')]),
        ]);

        $infosystem = Infosystem::findOne([
            'id' => $this->getData('get', 'infosystem_id'),
            'site_id' => Yii::$app->site->getId(),
        ]);

        if (!$infosystem) {

            return false;
        }

        $this->setData([
            'model' => $infosystem,
            'dataProvider' => $dataProvider,
        ]);

        return true;
    }
}