<?php
/**
 * Class SearchModel
 * @package app\modules\shop\models\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\models\backend;


use yii\base\Model;

class SearchModel extends Model
{
    public $id;

    public $name;

    public $create_time;

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'create_time'], 'string', 'max' => 255],
        ];
    }
}