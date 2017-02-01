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
    public function actionCreate(array $params)
    {
        $model = new Tag();
        $model->informationsystem_id = $params['get']['informationsystem_id'];

        if ($model->load($params['post']) and $model->save()) {
            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'model' => $model,
        ]);
    }
    
    public function actionUpdate(array $params)
    {
        $model = Tag::find()
            ->byId($params['get']['id'])
            ->one();

        if ($model->load($params['post']) && $model->save()) {
            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'model' => $model,
        ]);
    }
}