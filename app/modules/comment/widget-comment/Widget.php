<?php
/**
 * Class Widget
 * @package app\modules\comment\widgets\frontend\comment
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace kigl\cef\widget\comment;


use Yii;
use kigl\cef\widget\comment\forms\Comment as CommentForm;
use kigl\cef\module\comment\models\Comment;

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

        $form = new CommentForm();
        $model = new Comment([
            'model_class' => $this->modelClass,
            'item_id' => $this->itemId,
            //'status' => Comment::STATUS_DRAFT,
            'status' => Comment::STATUS_ACTIVE,
        ]);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $model->setAttributes($form->attributes);
            $model->save(false);

            $form->content = null;
            $form->parent_id = null;
        }

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