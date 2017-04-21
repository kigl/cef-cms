<?php
/**
 * Class CheckboxGroupColumn
 * @package kigl\cef\module\backend\widgets\grid
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\backend\widgets\grid;


use yii\grid\CheckboxColumn;

class CheckboxGroupColumn extends CheckboxColumn
{
    public $name = 'selectionGroup';

    public $multiple = false;
}