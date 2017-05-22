<?php
/**
 * Class Widget
 * @package app\modules\infosystem\widgets\listTags
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystems\widgets;


use yii\helpers\Html;
use yii\base\Model;

class ListTags extends \yii\base\Widget
{
    public $tags = [];

    public $infosystemId = '';

    public $options = ['class' => 'list-inline'];

    public $itemOptions = [];

    public $linkOptions = ['class' => 'label label-default'];

    public function run()
    {
        return Html::tag('ul', implode("", $this->getItems($this->infosystemId)), $this->options);
    }

    protected function getItems($infosystemId = '')
    {
        $result = [];
        foreach ($this->tags as $tag) {
            $result[] = $this->renderItem($tag, $infosystemId);
        }

        return $result;
    }

    protected function renderItem(Model $tag, $infosystemId)
    {
        return Html::tag('li', Html::a($tag->name, [
            '/infosystem/item/tag',
            'infosystem_id' => $infosystemId,
            'name' => $tag->name,
        ], $this->linkOptions), $this->itemOptions);
    }
}