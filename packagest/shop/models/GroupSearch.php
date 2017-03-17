<?php

namespace kigl\cef\module\shop\models;

use yii\data\ActiveDataProvider;
use kigl\cef\module\shop\models\Group;

class GroupSearch extends Group
{

    public function search($params)
    {
        $query = Group::find()
            ->where(['parent_id' => !empty($params['id']) ? $params['id'] : null]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider;
    }
}