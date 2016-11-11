<?php
/**
 * Class Widget
 * @package app\modules\shop\widgets\frontend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\widgets\frontend\treeGroup;


use app\modules\shop\models\Group;

class Widget extends \yii\base\Widget
{
    public function run()
    {
        $model = Group::find()->asArray()->all();

        //обойти массив и сделать индексы ключами parrent групп

        $data = [];
        foreach ($model as $group) {
            $data[$group['parent_id']][$group['id']] = $group;
        }


        echo "<pre>";
        print_r($data);
        echo "</pre>";

        $this->greatMenu($data, 0);
        //return $this->render('index');
    }

    public function greatMenu($menu, $parentId)
    {
        if (empty($menu[$parentId])) {
            return;
        }

        echo "<ul>";
        foreach ($menu[$parentId] as $pi) {

            echo "<li >" . $pi['name'];
                $this->greatMenu($menu, $pi['id']);
            echo "</li>";

        }
        echo "</ul>";
    }
}