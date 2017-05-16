<?php
/**
 * Class SimilarItem
 * @package app\modules\infosystem\widgets\similarItem
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystem\widgets;


use Yii;
use yii\helpers\Html;
use yii\base\Model;
use app\modules\infosystem\models\Item;

class SimilarItem extends \yii\base\Widget
{
    public $infosystemId;

    public $tagsId;

    public $currentItemId;

    public $itemOnPage = 3;

    public $formaDate = 'long';

    public $containerTag = 'div';

    public $headerTag = 'h2';

    public $headerText = '';

    public $itemsTag = 'div';

    public $itemsHeaderTag = 'h4';

    public $dateTag = 'p';

    public $containerOptions = ['class' => 'row'];

    public $headerOptions = [];

    public $headerLinkOptions = [];

    public $itemsOptions = ['class' => 'col-md-4'];

    public $imageOptions = [];

    public $itemsHeaderOptions = [];

    public $dateOptions = [];

    public function run()
    {
        echo Html::tag($this->containerTag,
            Html::tag($this->headerTag, $this->headerText, $this->headerOptions) . implode("\n", $this->getItems()),
            $this->containerOptions);
    }

    protected function getItems()
    {
        $result = [];

        foreach ($this->getModelItems() as $model) {
            $result[] = Html::tag($this->itemsTag,
                $this->getImage($model) . $this->getDate($model) . $this->getHeader($model),
                $this->itemsOptions);
        }

        return $result;
    }

    protected function getHeader(Model $model)
    {
        return Html::a(Html::tag($this->itemsHeaderTag, $model->name,
            $this->itemsHeaderOptions), $model->getModelItemUrl(), $this->headerLinkOptions);
    }

    protected function getImage(Model $model)
    {
        return Html::a(Html::img($model->getBehavior('imageDescription')->getFileUrl(), $this->imageOptions),
            $model->getModelItemUrl());
    }

    protected function getDate(Model $model)
    {
        return Html::tag($this->dateTag, Yii::$app->formatter->asDate($model->date, $this->formaDate),
            $this->dateOptions);
    }

    protected function getModelItems()
    {
        return Item::find()
            ->alias('item')
            ->joinWith(['itemTags as it'])
            ->where(['it.tag_id' => $this->tagsId])
            ->andWhere("item.id != :id", ['id' => $this->currentItemId])
            ->andWhere(['item.infosystem_id' => $this->infosystemId])
            ->orderBy(['item.counter' => SORT_DESC])
            ->groupBy('id')
            ->limit((integer)$this->itemOnPage)
            ->all();
    }
}