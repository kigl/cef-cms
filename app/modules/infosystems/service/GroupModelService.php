<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 20.02.2017
 * Time: 20:18
 */

namespace app\modules\infosystems\service;


use yii\data\ActiveDataProvider;
use app\modules\infosystems\models\Group;
use app\modules\infosystems\models\Item;

class GroupModelService extends ModelService
{
    public function actionView()
    {
        $model = Group::find()
            ->with(['infosystem'])
            ->where(['id' => $this->getData('get', 'id')])
            ->one();

        $dataProvider = new ActiveDataProvider([
            'query' => $model->getItems()
                ->with(['tags', 'properties'])
                ->where(['status' => Item::STATUS_ACTIVE]),

            'pagination' => [
                'pageSize' => $model->infosystem->item_on_page,
            ],

            'sort' => [
                'defaultOrder' => [
                    $model->infosystem->sorting_field_item => $model->infosystem->sorting_type_item,
                ],
                'attributes' => $model->infosystem->getSortingListFieldItem(),
            ],
        ]);

        if ($this->getData('get', 'alias') != $model->alias) {

            $this->setError(self::ERROR_NOT_MODEL_ALIAS);
        }

        $this->setData([
            'model' => $model,
            'dataProvider' => $dataProvider,
            'breadcrumbs' => $this->getItemsBreadcrumb($model->infosystem, $model->id),
        ]);
    }
}