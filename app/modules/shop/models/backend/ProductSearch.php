<?php

namespace app\modules\shop\models\backend;


use yii\data\ActiveDataProvider;

class ProductSearch extends Product
{
    public function rules()
    {
        return [
            [['name', 'id', 'create_time'], 'string'],
        ];
    }

    public function search($params)
    {
        $query = Product::find()
            ->where(['group_id' => !empty($params['id']) ? $params['id'] : null])
            ->parentIsNull();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['id' => $this->id]);
        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere([
            "date(create_time)" => $this->create_time
        ]);

        return $dataProvider;
    }

    public function beforeValidate()
    {
        if ($this->create_time != '') {
            $this->create_time = \Yii::$app->formatter->asDate($this->create_time, 'yyyy-MM-dd');
        }

        return true;
    }
}