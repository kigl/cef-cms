<?php
/**
 * Class BackendCurrencyController
 * @package app\modules\shop\controllers
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\controllers;


use Yii;
use app\modules\shop\models\backend\Currency;
use app\modules\shop\service\backend\CurrencyModelService;
use app\modules\backend\controllers\Controller;

class BackendCurrencyController extends Controller
{
    protected $_modelService;

    public function init()
    {
        parent::init();

        $this->_modelService = Yii::createObject([
            'class' => CurrencyModelService::className(),
            'data' => [
                'get' => Yii::$app->request->getQueryParams(),
                'post' => Yii::$app->request->post(),
            ],
        ]);
    }

    public function actionManager()
    {
        $this->_modelService->manager();

        return $this->render('manager', ['data' => $this->_modelService->getData()]);
    }

    public function actionCreate()
    {
        if ($this->_modelService->create()) {
            return $this->redirect(['manager']);
        }

        return $this->render('create', ['data' => $this->_modelService->getData()]);
    }

    public function actionUpdate($id)
    {
        if ($this->_modelService->update()) {
            return $this->redirect(['manager']);
        }

        return $this->render('update', ['data' => $this->_modelService->getData()]);
    }

    public function actionDelete($id)
    {
        $model = Currency::findOne($id);

        if ($model->delete()) {
            return $this->redirect(['manager']);
        }

        return null;
    }
}