<?php
/**
 * Class TextBlock
 * @package app\modules\infosystem\widgets
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystems\widgets;


use app\modules\infosystems\models\Item;
use yii\base\Widget;

class TextBlock extends Widget
{
    public $itemId;

    public function run()
    {
        $model = $this->getItem();

        echo $model->content;
    }

    public function getItem()
    {
        return Item::findOne($this->itemId);
    }
}