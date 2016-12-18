<?php
/**
 * Class GroupService
 * @package app\modules\shop\models\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\service\frontend;

use Yii;
use yii\data\ActiveDataProvider;
use app\core\service\ModelService;
use app\modules\shop\models\Group;

class GroupModelService extends ModelService
{
    /**
     * @todo $pageSize
     * @param int $pageSize
     */
    public function view($pageSize = 3)
    {
        $model = Group::find();

        if (Yii::$app->getModule('shop')->urlAlias) {
            $model->orWhere('alias = :alias', [':alias' => $this->getRequestData('get', 'id')]);
        } else {
            $model->where('id = :id', [':id' => $this->getRequestData('get', 'id')]);
        }

        $modelGroup = $model->one();

        $dataProviderProduct = new ActiveDataProvider([
            'query' => $modelGroup->getProducts()->with('mainImage'),
            'pagination' => [
                'pageSize' => $pageSize,
            ],
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
    }
}