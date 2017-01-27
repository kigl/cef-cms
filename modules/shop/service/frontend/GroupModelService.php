<?php
/**
 * Class GroupService
 * @package app\modules\shop\models\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\service\frontend;


use yii\data\ActiveDataProvider;
use app\modules\shop\models\Product;
use app\core\service\ModelService;
use app\modules\shop\models\Group;

class GroupModelService extends ModelService
{

    public function view()
    {
        $model = Group::find();

        $model->where(['id' => $this->getData('get', 'id')]);

        $modelGroup = $model->one();

        if (!$modelGroup) {
            $this->setError(self::ERROR_NOT_MODEL);
            return;
        }

        $dataProviderProduct = new ActiveDataProvider([
            'query' => $modelGroup->getProducts(),
            'sort' => [
                'defaultOrder' => [
                    'name' => SORT_ASC,
                ],
                'attributes' => ['id', 'name', 'price'],
            ],
        ]);

        $this->setData([
            'model' => $modelGroup,
            'dataProvider' => $dataProviderProduct,
        ]);

        /**@todo
         * проверка на алиас
         */
        if (!$this->hasData('get', 'alias')) {
            $this->setError(self::ERROR_NOT_MODEL_ALIAS);
        } elseif ($modelGroup->alias !== $this->getData('get', 'alias')) {
            $this->setError(self::ERROR_NOT_MODEL_ALIAS);
        }
    }
}