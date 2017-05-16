<?php
/**
 * Class Comment
 * @package app\modules\comment\widgets\frontend\comment\forms
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\comment\models\forms;


use Yii;
use yii\base\Model;

class Comment extends Model
{
    public $content;

    public $parent_id;

    public $model_class;

    public $item_id;

    public function rules()
    {
        return [
            ['content', 'required'],
            [['parent_id', 'item_id'], 'integer'],
            [['content', 'model_class'], 'string', 'max' => 400],
        ];
    }

    public function attributeLabels()
    {
        return [
            'content' => Yii::t('app', 'Content'),
        ];
    }
}