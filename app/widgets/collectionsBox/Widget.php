<?php
/**
 * Class Widget
 * @package app\widgets\collectionBox
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\widgets\collectionsBox;


class Widget extends \yii\base\Widget
{
    public function run()
    {
        return $this->render('index');
    }
}