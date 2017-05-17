<?php
/**
 * Class GroupModelService
 * @package app\modules\infosystem\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystem\service\backend;


use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\HttpException;
use app\modules\infosystem\models\Item;
use app\modules\infosystem\models\backend\Infosystem;
use app\modules\infosystem\models\backend\Group;
use app\modules\infosystem\models\backend\SearchModel;

class GroupModelService extends ModelService
{
    public function actionManager()
    {
        $searchModel = new SearchModel();

        $searchModel->load($this->getData('get'));

        $infosystem = Infosystem::findOne($this->getData('get', 'infosystem_id'));

        $groups = Group::find()
            ->where([
                'parent_id' => $this->getData('get', 'id'),
                'infosystem_id' => $this->getData('get', 'infosystem_id')
            ])
            ->asArray();

        $items = Item::find()
            ->where([
                'group_id' => $this->getData('get', 'id'),
                'infosystem_id' => $this->getData('get', 'infosystem_id')
            ])
            ->asArray();

        if ($searchModel->validate()) {
            $groups->andFilterWhere(['id' => $searchModel->id]);
            $groups->andFilterWhere(['like', 'name', $searchModel->name]);
            $items->andFilterWhere(['like', 'name', $searchModel->name]);
            $items->andFilterWhere(['id' => $searchModel->id]);
            $items->andFilterWhere(["date(date)" => $searchModel->date]);
        }

        $items = $items->all();
        ArrayHelper::multisort($items, 'sorting');

        $dataProvider = (new ArrayDataProvider([
            'allModels' => array_merge($groups->all(), $items),
            'sort' => [
                'attributes' => ['id', 'name', 'date', 'sorting'],
            ],
        ]));

        $this->setData([
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'infosystem' => $infosystem,
            'breadcrumbs' => $this->getItemsBreadcrumb($infosystem, $this->getData('get', 'id')),
            'id' => $this->getData('get', 'id'),
        ]);
    }

    public function actionCreate()
    {
        $model = new Group([
            'parent_id' => $this->getData('get', 'parent_id'),
            'infosystem_id' => $this->getData('get', 'infosystem_id'),
        ]);

        $this->setData([
            'model' => $model,
            'breadcrumbs' => $this->getItemsBreadcrumb($model->infosystem, $model->parent_id),
        ]);

        if ($model->load($this->getData('post')) && $model->save()) {

            return true;
        }

        return false;
    }

    public function actionUpdate()
    {
        $model = Group::find()
            ->where(['id' => $this->getData('get', 'id')])
            ->with('infosystem')
            ->one();

        if (!$model) {
            throw new HttpException(500);
        }

        $this->setData([
            'model' => $model,
            'breadcrumbs' => $this->getItemsBreadcrumb($model->infosystem, $model->id, $model->name),
        ]);

        if ($model->load($this->getData('post')) && $model->save()) {
            return true;
        }

        return false;
    }

    public function actionDelete($id)
    {
        $model = Group::find()
            ->where(['id' => $id])
            ->with(['subGroups', 'items'])
            ->one();

        if (!$model) {
            throw new HttpException(500);
        }

        $this->setData([
            'model' => $model,
        ]);

        if ($model && $model->delete()) {

            foreach ($model->items as $item) {
                $itemModelService = new ItemModelService();
                $itemModelService->actionDelete($item->id);
            }

            foreach ($model->subGroups as $group) {
                $this->actionDelete($group->id);
            }

            return true;
        }

        return false;
    }
}
