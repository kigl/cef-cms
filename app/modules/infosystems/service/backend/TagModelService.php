<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 09.01.2017
 * Time: 19:21
 */

namespace app\modules\infosystems\service\backend;


use yii\data\ActiveDataProvider;
use app\modules\infosystems\models\backend\Tag;

class TagModelService extends ModelService
{
    public function manager()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Tag::find(),
        ]);
        $this->setData([
            'dataProvider' => $dataProvider,
        ]);
    }

    public function create()
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

    public function update()
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