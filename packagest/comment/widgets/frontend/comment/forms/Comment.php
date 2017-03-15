<?php
/**
 * Class Comment
 * @package app\modules\comment\widgets\frontend\comment\forms
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\comment\widgets\frontend\comment\forms;


use Yii;
use yii\base\Model;

class Comment extends Model
{
    public $content;

    public $parent_id;

    public function rules()
    {
        return [
            ['content', 'required'],
            ['parent_id', 'integer'],
            ['content', 'string', 'max' => 400],
        ];
    }

    public function attributeLabels()
    {
        return [
            'content' => Yii::t('app', 'Content'),
        ];
    }
}