<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 10.01.2017
 * Time: 20:53
 */

/**
 * @todo
 * Добавить rule object
 */

namespace app\modules\users\controllers;


use Yii;
use app\modules\backend\controllers\Controller;
use app\modules\users\service\backend\RbacModelService;

/**
 * Class RbacController
 * @package app\modules\user\controllers\backend
 */
class BackendRbacController extends Controller
{
    public function actionManager()
    {
        $modelService = Yii::createObject(RbacModelService::class);
        $modelService->manager();

        return $this->render('manager', ['data' => $modelService->getData()]);
    }

    public function actionCreate()
    {
        $modelService = Yii::createObject([
            'class' => RbacModelService::class,
            'data' => [
                'post' => Yii::$app->request->post(),
            ],
        ]);

        if ($modelService->create()) {

            return $this->redirect(['backend-rbac/manager']);
        }

        return $this->render('create', ['data' => $modelService->getData()]);
    }

    public function actionUpdate($name, $type)
    {
        $modelService = Yii::createObject([
            'class' => RbacModelService::class,
            'data' => [
                'get' => Yii::$app->request->getQueryParams(),
                'post' => Yii::$app->request->post(),
            ],
        ]);


        if ( $modelService->update()) {

            return $this->redirect(['backend-rbac/manager']);
        }

        return $this->render('update', ['data' => $modelService->getData()]);
    }

    public function actionDelete($type, $name)
    {
        $modelService = Yii::createObject(RbacModelService::class);

        if ($modelService->delete($type, $name)) {

            return $this->redirect(['backend-rbac/manager']);
        }

        return null;
    }
}