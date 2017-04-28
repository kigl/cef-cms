<?php
/**
 * Class ListItems
 * @package kigl\ceg\module\lists\widgets
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\lists\widgets;


use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class DropDownItems extends BaseItems
{
    public $model;

    public $attribute;

    public $listId;

    public function run()
    {
        return Html::activeDropDownList($this->model, $this->attribute,
            ArrayHelper::map(
                $this->getItems(),
                'value',
                'value'),
            ['class' => 'form-control', 'prompt' => Yii::t('yii', '(not set)')]
        );
    }
}