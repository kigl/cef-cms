<?php
/**
 * Class GroupService
 * @package app\modules\shop\models\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\models\frontend;

use Yii;
use yii\data\ActiveDataProvider;
use app\core\service\ModelService;
use app\modules\shop\models\Group;

class GroupService extends ModelService
{
    public function view()
    {
        $modelGroup = Group::find()->where('id = :id', [':id' => $this->getRequestData('get', 'id')]);

        if (Yii::$app->getModule('shop')->urlAlias) {
            $modelGroup->orWhere('alias = :alias', [':alias' => $this->getRequestData('get', 'id')]);
        }
        $model = $modelGroup->one();

        $dataProvider = new ActiveDataProvider([
            'query' => $model->getProducts(),
        ]);

        $this->setData([
            'group' => $model,
            'dataProviderProduct' => $dataProvider,
        ]);
    }
}