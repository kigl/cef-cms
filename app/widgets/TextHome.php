<?php
/**
 * Class TextHome
 * @package app\widgets
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\widgets;


use app\modules\infosystem\models\Item;
use yii\base\Widget;

class TextHome extends Widget
{
    public function run()
    {
        $model = Item::find()
            ->where(['infosystem_id' => 'site', 'name' => 'anomoda.ru'])
            ->one();

        return $model->content;
    }
}