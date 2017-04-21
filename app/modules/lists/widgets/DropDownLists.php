<?php
/**
 * Class DropDownLists
 * @package kigl\cef\module\lists\widgets
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\lists\widgets;


use app\modules\lists\models\Lists;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class DropDownLists extends Widget
{
    public $model;

    public $attribute;

    public $options = [];

    public function run()
    {
        $model = Lists::find()
            ->asArray()
            ->all();

        return Html::activeDropDownList(
            $this->model,
            $this->attribute,
            ArrayHelper::map($model, 'id', 'name'),
            $this->options
        );
    }
}