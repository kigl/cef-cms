<?php

namespace kigl\cef\module\shop\models;

use yii\data\ActiveDataProvider;

class ProductSearch extends Product
{
    public function search($params)
    {
        $query = Product::find()
            ->where(['group_id' => !empty($params['id']) ? $params['id'] : null])
            ->parentIsNull();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) return $dataProvider;

        return $dataProvider;
    }
}