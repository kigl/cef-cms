<?php
/**
 * Class InfosystemModelService
 * @package app\modules\infosystem\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystem\service\backend;


use Yii;
use yii\data\ActiveDataProvider;
use app\core\service\ModelService;
use app\modules\infosystem\models\Infosystem;

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

        if ($model->load($this->getData('post')) && $model->save()) {
            $this->hasExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $model->getProperties(),
        ]);

        $this->setData([
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdate()
    {
        $model = Infosystem::find()
            ->where(['id' => $this->getData('get', 'id')])
            ->one();

        if ($model->load($this->getData('post')) && $model->save()) {
            $this->hasExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $model->getProperties(),
        ]);

        $this->setData([
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDelete($id)
    {
        $modelSystem = Infosystem::find()
            ->where(['id' => $id])
            ->with(['groups'])
            ->one();

        if ($modelSystem && $modelSystem->delete()) {

            /**
             * @todo пересмотреть удаление group и item
             */
            foreach ($modelSystem->groups as $group) {
                Yii::createObject(GroupModelService::class)->actionDelete($group->id);
            }

            $items = $modelSystem->getItems()
                ->all();

            foreach ($items as $item) {
                Yii::createObject(Infosystem::class)->actionDelete($item->id);
            }

            $this->setExecutedAction(self::EXECUTED_ACTION_DELETE);
        }

        $this->setData([
            'model' => $modelSystem,
        ]);
    }
}