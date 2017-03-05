<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 09.01.2017
 * Time: 19:21
 */

namespace app\modules\tag\service\backend;


use Yii;
use app\core\service\ModelService;
use app\modules\tag\models\Tag;
use app\modules\tag\models\TagSearch;


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
        ]);
    }
}