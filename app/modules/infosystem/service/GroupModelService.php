<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 20.02.2017
 * Time: 20:18
 */

namespace app\modules\infosystem\service;


use yii\data\ActiveDataProvider;
use app\modules\infosystem\models\Group;

class GroupModelService extends ModelService
{
    public function actionView()
    {
        $model = Group::find()
            ->with(['infosystem'])
            ->where(['id' => $this->getData('get', 'id')])
            ->one();

        $dataProvider = new ActiveDataProvider([
            'query' => $model->getItems(),
            'pagination' => [
                'pageSize' => $model->infosystem->item_on_page,
            ],
            'sort' => [
                'defaultOrder' => [
                    $model->infosystem->sorting_attribute_item => $model->infosystem->sorting_type_item,
                ],
                'attributes' => $model->infosystem->getSortingListAttributeItem(),
            ],
        ]);

        if ($this->getData('get', 'alias') != $model->alias
            || $this->getData('get', 'infosystem_id') != $model->infosystem_id
        ) {

            $this->setError(self::ERROR_NOT_MODEL_ALIAS);
        }

        $this->setData([
            'model' => $model,
            'dataProvider' => $dataProvider,
            'breadcrumbs' => $this->getItemsBreadcrumb($model->infosystem, $model->id),
        ]);
    }
}