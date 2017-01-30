<?php

namespace app\modules\shop\models;

use yii\data\ActiveDataProvider;
use app\modules\shop\models\Group;

class GroupSearch extends Group
{

    public function search($id, $params)
    {
        $query = Group::find()
            ->where(['parent_id' => $id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider;
    }
}