<?php

namespace app\modules\shop\models;

use yii\data\ActiveDataProvider;
use app\modules\shop\models\Group;

class GroupSearch extends Group
{

    public function search($params)
    {
        $query = Group::find()
            ->where(['parent_id' => $params['id']]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider;
    }
}