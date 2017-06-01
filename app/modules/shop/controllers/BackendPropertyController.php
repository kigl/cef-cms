<?php
/**
 * Created by PhpStorm.
 * User: ARstudio
 * Date: 26.10.2016
 * Time: 18:01
 */

namespace app\modules\shop\controllers;


use Yii;
use app\modules\shop\service\backend\PropertyModelService;
use app\modules\backend\controllers\Controller;
use app\modules\shop\models\backend\Property;

class BackendPropertyController extends Controller
{
    private $_modelService;

    public function init()
    {
        parent::init();

        $this->_modelService = Yii::createObject([
            'class' => PropertyModelService::className(),
            'data' => [
                'get' => Yii::$app->request->getQueryParams(),
                'post' => Yii::$app->request->post(),
            ],
        ]);
    }

    public function actionManager($shop_id)
    {
        $this->_modelService->manager();

        return $this->render('manager', ['data' => $this->_modelService->getData()]);
    }

    public function actionCreate($shop_id)
    {
        if ($this->_modelService->create()) {
            return $this->redirect(['manager', 'shop_id' => $shop_id]);
        }

        return $this->render('create', ['data' => $this->_modelService->getData()]);
    }

    public function actionUpdate($id)
    {
        if ($this->_modelService->update()) {
            return $this->redirect(['manager', 'shop_id' => $this->_modelService->data['model']->shop_id]);
        }

        return $this->render('update', ['data' => $this->_modelService->getData()]);
    }

    public function actionDelete($id)
    {
        $model = Property::findOne($id);

        if ($model->delete()) {
            return $this->redirect(['manager', 'shop_id' => $model->shop_id]);
        }

        return null;
    }
}