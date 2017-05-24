<?php
/**
 * Class FromModelService
 * @package app\modules\service\service
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\forms\service\backend;


use Yii;
use yii\data\ActiveDataProvider;
use app\modules\forms\models\backend\Form;

class FormModelService extends ModelService
{
    public function actionManager()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Form::find()
                ->where(['site_id' => Yii::$app->site->getId()])
        ]);

        $this->setData([
            'dataProvider' => $dataProvider,
            'breadcrumbs' => $this->getItemsBreadcrumb()
        ]);
    }
}