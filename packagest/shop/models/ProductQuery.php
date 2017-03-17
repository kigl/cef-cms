<?php
/**
 * Class ProductQuery
 * @package app\modules\shop\models\query
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace kigl\cef\module\shop\models;


use yii\db\ActiveQuery;

class ProductQuery extends ActiveQuery
{
    public function parentIsNull()
    {
        return $this->andWhere('parent_id IS NULL');
    }
}