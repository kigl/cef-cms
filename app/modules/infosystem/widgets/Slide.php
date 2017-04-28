<?php
/**
 * Class Widget
 * @package app
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystem\widgets;


use yii\helpers\Html;
use yii\bootstrap\Carousel;
use app\modules\infosystem\models\Item;

class Slide extends \yii\base\Widget
{

    const TYPE_SLIDE = 1;
    const TYPE_CONTENT = 2;

    public $type;

    public $groupId;

    public $options;

    public $controls = [
        '<i class="glyphicon glyphicon-chevron-left"></i>',
        '<i class="glyphicon glyphicon-chevron-right"></i>',
    ];

    public function run()
    {
        echo Carousel::widget([
            'items' => $this->getImages(),
            'options' => $this->options,
            'controls' => $this->controls,
        ]);
    }

    protected function getItems()
    {
        return Item::findAll(['group_id' => $this->groupId]);
    }

    protected function getImages()
    {
        $models = $this->getItems();

        $result = [];

        foreach ($models as $model) {
            $link = $model->getBehavior('imageContent')->getFileUrl();
            $result[] = Html::img($link);
        }

        return $result;
    }
}