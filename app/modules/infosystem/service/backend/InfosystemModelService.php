<?php
/**
 * Class InfosystemModelService
 * @package app\modules\infosystem\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystem\service\backend;


use Yii;
use yii\data\ActiveDataProvider;
use yii\web\HttpException;
use app\modules\infosystem\models\backend\Group;
use app\modules\infosystem\models\backend\Item;
use app\modules\infosystem\models\backend\Infosystem;

class InfosystemModelService extends ModelService
{
    protected $model;

    public function actionManager()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => infosystem::find(),
        ]);

        $this->setData([
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $this->model = new Infosystem();

        $dataProvider = new ActiveDataProvider([
            'query' => $this->model->getProperties(),
        ]);

        $this->setData([
            'model' => $this->model,
            'dataProvider' => $dataProvider,
        ]);

        return $this->save();
    }

    public function actionUpdate()
    {
        $this->model = Infosystem::find()
            ->where(['id' => $this->getData('get', 'id')])
            ->one();

        if (!$this->model) {
            throw new HttpException(500);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $this->model->getProperties(),
            'sort' => [
                'defaultOrder' => ['sorting' => SORT_ASC],
            ],
        ]);

        $this->setData([
            'model' => $this->model,
            'dataProvider' => $dataProvider,
        ]);

        return $this->save();
    }

    public function actionDelete($id)
    {
        $this->model = Infosystem::find()
            ->where(['id' => $id])
            ->with(['groups'])
            ->one();

        if (!$this->model) {
            throw new HttpException(500);
        }

        $this->setData([
            'model' => $this->model,
        ]);

        if ($this->model && $this->model->delete()) {

            foreach ($this->model->groups as $group) {
                Yii::createObject(GroupModelService::class)->actionDelete($group->id);
            }

            $items = $this->model->getItems()
                ->all();

            foreach ($items as $item) {
                Yii::createObject(ItemModelService::class)->actionDelete($item->id);
            }

            return true;
        }

        return false;
    }

    protected function save($validate = true)
    {
        if ($this->model->load(Yii::$app->request->post()) && $this->model->validate($validate)) {

            if (!$this->model->isNewRecord && $this->model->isChangeId()) {

                Group::updateAll(['infosystem_id' => $this->model->id], ['infosystem_id' => $this->model->getOldAttribute('id')]);
                Item::updateAll(['infosystem_id' => $this->model->id], ['infosystem_id' => $this->model->getOldAttribute('id')]);
            }

            $this->model->save(false);

            return true;
        }

        return false;
    }
}