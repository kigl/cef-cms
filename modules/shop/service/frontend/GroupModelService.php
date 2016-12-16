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
    public function view($pageSize = 5)
    {
        $modelGroup = Group::find();

        if (Yii::$app->getModule('shop')->urlAlias) {
            $modelGroup->orWhere('alias = :alias', [':alias' => $this->getRequestData('get', 'id')]);
        } else {
            $modelGroup->where('id = :id', [':id' => $this->getRequestData('get', 'id')]);
        }

        $model = $modelGroup->one();

        $dataProvider = new ActiveDataProvider([
            'query' => $model->getProducts()->with('mainImage'),
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
            'model' => $model,
            'dataProviderProduct' => $dataProvider,
        ]);
    }
}