<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 20.02.2017
 * Time: 20:18
 */

namespace app\modules\infosystem\service;


use yii\data\ActiveDataProvider;
use app\modules\infosystem\models\Item;
use app\modules\infosystem\models\Infosystem;

class ItemModelService extends ModelService
{
    public function view()
    {
        $model = Item::find()
            ->with(['infosystem', 'tags'])
            ->where(['id' => $this->getData('get', 'id'), 'status' => Item::STATUS_ACTIVE])
            ->one();

        if (!$model) {

            return false;
        }

        $model->updateCounters(['counter' => 1]);

        if ($this->getData('get', 'alias') != $model->alias
            || $this->getData('get', 'infosystem_id') != $model->infosystem_id
        ) {

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
                ->where(['tag.name' => $this->getData('get', 'name')]),
        ]);

        $infosystem = Infosystem::findOne(['id' => $this->getData('get', 'infosystem_id')]);

        if (!$infosystem) {
            $this->setError(self::ERROR_NOT_MODEL);
        }

        $this->setData([
            'model' => $infosystem,
            'dataProvider' => $dataProvider,
        ]);
    }
}