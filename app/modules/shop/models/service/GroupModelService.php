<?php
/**
 * Class GroupService
 * @package app\modules\shop\models\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace kigl\module\shop\models\service\frontend;


use yii\data\ActiveDataProvider;
use kigl\cef\core\traits\Breadcrumbs;
use kigl\cef\core\service\ModelService;
use kigl\cef\module\shop\models\Group;

class GroupModelService extends ModelService
{
    use Breadcrumbs;

    public function actionView()
    {
        $model = Group::find();

        $model->where(['id' => $this->getData('get', 'id')])
            ->with('subGroups');

        $modelGroup = $model->one();

        if (!$modelGroup) {
            $this->setError(self::ERROR_NOT_MODEL);
            return;
        }

        $dataProviderProduct = new ActiveDataProvider([
            'query' => $modelGroup->getProducts()
                ->with('mainImage'),
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
            'subGroups' => $modelGroup->subGroups,
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
