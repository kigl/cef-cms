<?php
/**
 * Class CheckboxItemColumn
 * @package kigl\cef\module\backend\widgets\grid
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\backend\widgets\grid;


use yii\grid\CheckboxColumn;

class CheckboxItemColumn extends CheckboxColumn
{
    public $name = 'selectionItem';

    public $multiple = false;
}