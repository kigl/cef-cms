<?php
/**
 * Class InformationSysmteModelService
 * @package app\modules\informationsystem\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\informationsystem\service\backend;


use Yii;
use yii\data\ActiveDataProvider;
use app\core\service\ModelService;
use app\modules\informationsystem\models\Informationsystem as System;

class InformationSystemModelService extends ModelService
{
    public function actionManager()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => System::find(),
        ]);

        $this->setData([
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDelete($id)
    {
        $modelSystem = System::find()
            ->where(['id' => $id])
            ->with(['itemGroups'])
            ->one();

        if ($modelSystem && $modelSystem->delete()) {

            foreach ($modelSystem->itemGroups as $group) {
                Yii::createObject(GroupModelService::class)->actionDelete($group->id);
            }

            $items = $modelSystem->getItems()
                ->all();

            foreach ($items as $item) {
                Yii::createObject(ItemModelService::class)->actionDelete($item->id);
            }

            $this->setExecutedAction(self::EXECUTED_ACTION_DELETE);
        }

        $this->setData([
            'model' => $modelSystem,
        ]);
    }
}