<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 09.01.2017
 * Time: 19:21
 */

namespace app\modules\infosystem\service\backend;


use yii\data\ActiveDataProvider;
use app\modules\infosystem\models\backend\Tag;

class TagModelService extends ModelService
{
    public function actionManager()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Tag::find(),
        ]);
        $this->setData([
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Tag();

        $this->setData([
            'model' => $model,
        ]);

        if ($model->load($this->getData('post')) and $model->save()) {
            return true;
        }

        return false;
    }

    public function actionUpdate()
    {
        $model = Tag::find()
            ->where(['id' => $this->getData('get', 'id')])
            ->one();

        $this->setData([
            'model' => $model,
        ]);

        if ($model->load($this->getData('post')) && $model->save()) {
            return true;
        }

        return false;
    }
}