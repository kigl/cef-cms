<?php
/**
 * Class FromModelService
 * @package app\modules\service\service
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\service\modules\form\service;


use yii\data\ActiveDataProvider;
use app\modules\service\modules\form\models\Form;
use app\core\service\ModelService;

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