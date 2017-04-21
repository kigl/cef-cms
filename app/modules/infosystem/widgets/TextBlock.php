<?php
/**
 * Class TextBlock
 * @package app\modules\infosystem\widgets
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystem\widgets;


use app\modules\infosystem\models\Item;
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