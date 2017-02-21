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