<?php

namespace app\modules\shop\models\backend;


use yii\data\ActiveDataProvider;

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