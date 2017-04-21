<?php
/**
 * Class FromModelService
 * @package app\modules\service\service
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\form\models\backend\service;


use yii\data\ActiveDataProvider;
use app\core\service\ModelService;
use app\modules\form\models\backend\Form;

class FormModelService extends ModelService
{
    public function actionManager()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Form::find(),
        ]);

        $this->setData([
            'dataProvider' => $dataProvider,
        ]);
    }
}