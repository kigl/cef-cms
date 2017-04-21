<?php
/**
 * Class InfosystemModelService
 * @package app\modules\infosystem\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystem\models\backend\service;


use Yii;
use yii\data\ActiveDataProvider;
use yii\web\HttpException;
use app\core\service\ModelService;
use app\modules\infosystem\models\backend\Infosystem;

class InfosystemModelService extends ModelService
{
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
        $model = new Infosystem();

        $dataProvider = new ActiveDataProvider([
            'query' => $model->getProperties(),
        ]);

        $this->setData([
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);

        if ($model->load($this->getData('post')) && $model->save()) {

            return true;
        }

        return false;
    }

    public function actionUpdate()
    {
        $model = Infosystem::find()
            ->where(['id' => $this->getData('get', 'id')])
            ->one();

        if (!$model) {
            throw new HttpException(500);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $model->getProperties(),
            'sort' => [
                'defaultOrder' => ['sorting' => SORT_ASC],
            ],
        ]);

        $this->setData([
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);

        if ($model->load($this->getData('post')) && $model->save()) {

            return true;
        }

        return false;
    }

    public function actionDelete($id)
    {
        $model = Infosystem::find()
            ->where(['id' => $id])
            ->with(['groups'])
            ->one();

        if (!$model) {
            throw new HttpException(500);
        }

        $this->setData([
            'model' => $model,
        ]);

        if ($model && $model->delete()) {

            /**
             * @todo
             * пересмотреть удаление group и item
             */
            foreach ($model->groups as $group) {
                Yii::createObject(GroupModelService::class)->actionDelete($group->id);
            }

            $items = $model->getItems()
                ->all();

            foreach ($items as $item) {
                Yii::createObject(Infosystem::class)->actionDelete($item->id);
            }

            return true;
        }

        return false;
    }
}