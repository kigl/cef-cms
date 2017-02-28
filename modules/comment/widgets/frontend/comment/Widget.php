<?php
/**
 * Class Widget
 * @package app\modules\comment\widgets\frontend\comment
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\comment\widgets\frontend\comment;


use Yii;
use app\modules\comment\widgets\frontend\comment\forms\Comment as CommentForm;
use app\modules\comment\models\Comment;

class Widget extends \yii\base\Widget
{
    public $modelClass;

    public $itemId;

    public function run()
    {
        $form = new CommentForm();
        $model = new Comment([
            'model_class' => $this->modelClass,
            'item_id' => $this->itemId,
            'status' => Comment::STATUS_DRAFT,
        ]);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $model->setAttributes($form->attributes);
            $model->save();
            $form->content = null;
        }

        $models = Comment::find()
            ->where(['model_class' => $this->modelClass])
            //->andWhere(['status' => Comment::STATUS_ACTIVE])
            ->andWhere(['item_id' => $this->itemId])
            ->with('user')
            ->all();

        return $this->render('index', [
            'data' => [
                'form' => $form,
                'items' => $models,
            ]
        ]);
    }
}