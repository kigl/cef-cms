<?php
/**
 * Class InfosystemModelService
 * @package app\modules\infosystem\service
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystem\service;


use yii\data\ActiveDataProvider;
use app\modules\infosystem\models\Infosystem;
use app\modules\infosystem\models\Group;
use app\modules\infosystem\models\Item;

class InfosystemModelService extends ModelService
{
    public function view()
    {
        $model = Infosystem::findOne(['id' => $this->getData('get', 'id')]);

        $dataProviderGroup = new ActiveDataProvider([
            'query' => Group::find()
                ->where(['infosystem_id' => $model->id, 'parent_id' => null,]),
            'pagination' => [
                'pageSize' => $model->group_on_page,
            ],
            'sort' => [
                'defaultOrder' => [
                    $model->sorting_attribute_group => $model->sorting_type_group,
                ],
                'attributes' => $model->getSortingListAttributeItem(),
            ],
        ]);

        $dataProviderItem = new ActiveDataProvider([
            'query' => Item::find()
                ->where(['infosystem_id' => $model->id, 'group_id' => null]),
            'pagination' => [
                'pageSize' => $model->item_on_page,
            ],
            'sort' => [
                'defaultOrder' => [
                    $model->sorting_attribute_item => $model->sorting_type_item,
                ],
                'attributes' => $model->getSortingListAttributeItem(),
            ],
        ]);

        $this->setData([
            'model' => $model,
            'dataProviderGroup' => $dataProviderGroup,
            'dataProviderItem' => $dataProviderItem,
            'breadcrumbs' => $this->getItemsBreadcrumb($model)
        ]);

        return true;
    }
}