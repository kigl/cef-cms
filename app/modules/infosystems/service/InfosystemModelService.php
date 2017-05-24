<?php
/**
 * Class InfosystemModelService
 * @package app\modules\infosystem\service
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystems\service;


use Yii;
use yii\data\ActiveDataProvider;
use app\modules\infosystems\models\Infosystem;
use app\modules\infosystems\models\Group;
use app\modules\infosystems\models\Item;

class InfosystemModelService extends ModelService
{
    public function view()
    {
        $model = Infosystem::findOne([
            'id' => $this->getData('get', 'id'),
            'site_id' => Yii::$app->site->getId(),
            ]);

        if (!$model) {
            return false;
        }

        $dataProviderGroup = new ActiveDataProvider([
            'query' => Group::find()
                ->where([
                    'infosystem_id' => $model->id,
                    'parent_id' => null,
                    'status' => Group::STATUS_ACTIVE,
                ]),
            'pagination' => [
                'pageSize' => $model->group_on_page,
            ],
            'sort' => [
                'defaultOrder' => [
                    $model->sorting_field_group => $model->sorting_type_group,
                ],
                'attributes' => $model->getSortingListFieldGroup(),
            ],
        ]);

        $dataProviderItem = new ActiveDataProvider([
            'query' => Item::find()
                ->where([
                    'infosystem_id' => $model->id,
                    'group_id' => null,
                    'status' => Item::STATUS_ACTIVE,
                ]),
            'pagination' => [
                'pageSize' => $model->item_on_page,
            ],
            'sort' => [
                'defaultOrder' => [
                    $model->sorting_field_item => $model->sorting_type_item,
                ],
                'attributes' => $model->getSortingListFieldItem(),
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