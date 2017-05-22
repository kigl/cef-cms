<?php
/**
 * Class SearchModel
 * @package app\modules\infosystem\models\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystems\models\backend;


use yii\base\Model;

class SearchModel extends Model
{
    public $id;

    public $name;

    public $date;

    public function rules()
    {
        return [
            ['id', 'integer'],
            [['name', 'date'], 'string'],
            ['date', 'date', 'format' => 'yyyy-MM-dd'],
        ];
    }

    public function beforeValidate()
    {
        if ($this->date !== '' && $this->date != null) {
            $this->date = \Yii::$app->formatter->asDate($this->date, 'yyyy-MM-dd');
        }

        return parent::beforeValidate();
    }
}