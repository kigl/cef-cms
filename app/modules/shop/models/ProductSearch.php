<?php

namespace app\modules\shop\models;

use yii\data\ActiveDataProvider;
use app\modules\shop\models\Product;

class ProductSearch extends Product
{
    public function search($group_id, $params)
    {
        $query = Product::find()
            ->where('group_id = :groupId', [':groupId' => $group_id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) return $dataProvider;

        return $dataProvider;
    }
}