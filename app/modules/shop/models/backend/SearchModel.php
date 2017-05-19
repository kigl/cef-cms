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
            ['create_time', 'date', 'format' => 'yyyy-MM-dd'],
        ];
    }

    public function beforeValidate()
    {
        if ($this->create_time !== '' && $this->create_time != null) {
            $this->create_time = \Yii::$app->formatter->asDate($this->create_time, 'yyyy-MM-dd');
        }

        return parent::beforeValidate();
    }
}