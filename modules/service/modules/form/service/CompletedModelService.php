<?php
/**
 * Class FormCompletedModelService
 * @package app\modules\service\service
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\service\modules\form\service;


use yii\data\ActiveDataProvider;
use app\modules\service\modules\form\models\Completed;
use app\core\service\ModelService;

class CompletedModelService extends ModelService
{
    public function actionManager()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Completed::find()
                ->where(['form_id' => $this->getData('get', 'form_id')]),
        ]);

        $this->setData([
            'dataProvider' => $dataProvider,
        ]);
    }
}