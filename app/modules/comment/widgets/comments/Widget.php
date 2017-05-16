<?php
/**
 * Class Widget
 * @package app\modules\comment\widgets\frontend\comment
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\comment\widgets\comments;


use app\modules\comment\models\forms\Comment as CommentForm;
use app\modules\comment\models\Comment;

class Widget extends \yii\base\Widget
{
    public $modelClass;

    public $itemId;

    public function run()
    {

        /**
         * @todo
         * Добавить возможность редактировать комментария автору ?
         */

        $form = new CommentForm([
            'model_class' => $this->modelClass,
            'item_id' => $this->itemId,
        ]);

        $items = $this->getAllItems();

        return $this->render('index', [
            'data' => [
                'form' => $form,
                'items' => $items,
                'count' => count($items),
            ]
        ]);
    }

    protected function getAllItems()
    {
        return Comment::find()
            ->where(['model_class' => $this->modelClass])
            ->andWhere(['status' => Comment::STATUS_ACTIVE])
            ->andWhere(['item_id' => $this->itemId])
            ->with('user')
            ->all();
    }
}