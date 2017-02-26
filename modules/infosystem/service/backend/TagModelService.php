<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 09.01.2017
 * Time: 19:21
 */

namespace app\modules\infosystem\service\backend;


use Yii;
use app\core\service\ModelService;
use app\modules\infosystem\models\Tag;
use app\modules\infosystem\models\TagSearch;


class TagModelService extends ModelService
{
    public function actionManager()
    {
        $model = new TagSearch;

        $dataProvider = $model->search(Yii::$app->request->getQueryParams());

        $this->setData([
            'dataProvider' => $dataProvider,
            'searchModel' => $model,
        ]);
    }

    public function actionCreate()
    {
        $model = new Tag();

        if ($model->load($this->getData('post')) and $model->save()) {
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