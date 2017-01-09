<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 09.01.2017
 * Time: 19:21
 */

namespace app\modules\informationsystem\service\backend;


use app\core\service\ModelService;
use app\modules\informationsystem\models\Tag;

class TagModelService extends ModelService
{
    public function actionCreate()
    {
        $model = new Tag();
        $model->informationsystem_id = $this->getData('get', 'informationsystem_id');

        if ($model->load($this->getData('post')) and $model->save()) {
            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'model' => $model,
            'informationsystemId' => $model->informationsystem_id,
        ]);
    }
    
    public function actionUpdate()
    {
        $model = Tag::find()
            ->byId($this->getData('get', 'id'))
            ->one();

        if ($model->load($this->getData('post')) && $model->save()) {
            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'model' => $model,
            'informationsystemId' => $model->informationsystem_id,
        ]);
    }
}