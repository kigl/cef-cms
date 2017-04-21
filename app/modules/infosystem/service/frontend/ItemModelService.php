<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 20.02.2017
 * Time: 20:18
 */

namespace app\modules\infosystem\service\frontend;


use app\core\service\ModelService;
use app\modules\infosystem\models\Item;

class ItemModelService extends ModelService
{
    public function actionView()
    {
        $model = Item::find()
            ->with(['infosystem'])
            ->where(['id' => $this->getData('get', 'id')])
            ->one();


        if ($this->getData('get', 'alias') != $model->alias
            || $this->getData('get', 'infosystem_id') != $model->infosystem_id
        ) {

            $this->setError(self::ERROR_NOT_MODEL_ALIAS);
        }

        $this->setData([
            'model' => $model,
        ]);
    }
}