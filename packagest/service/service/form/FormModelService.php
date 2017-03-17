<?php
/**
 * Class FromModelService
 * @package app\modules\service\service
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace kigl\cef\module\service\service\form;


use yii\data\ActiveDataProvider;
use kigl\cef\module\service\models\form\Form;
use kigl\cef\core\service\ModelService;

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