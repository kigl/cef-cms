<?php
/**
 * Class BaseItems
 * @package app\modules\lists\widgets
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\lists\widgets;


use yii\base\Widget;
use app\modules\lists\models\Item;

abstract class BaseItems extends Widget
{
    public $model;

    public $attribute;

    public $listId;

    protected function getItems()
    {
        return Item::find()
            ->where(['list_id' => $this->listId])
            ->asArray()
            ->all();
    }
}