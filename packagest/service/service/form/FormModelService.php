<?php
/**
 * Class FromModelService
 * @package app\modules\service\service
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\service\service\form;


use yii\data\ActiveDataProvider;
use app\modules\service\models\form\Form;
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