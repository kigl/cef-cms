<?php
/**
 * Class CommentController
 * @package app\modules\comment\controllers
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\comment\controllers;


use Yii;
use app\controllers\Controller;
use app\modules\comment\models\Comment;
use app\modules\comment\models\forms\Comment as CommentForm;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use yii\widgets\ActiveForm;

class CommentController extends Controller
{
    public function actionAdd()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $form = new CommentForm();
        $model = new Comment();
        $request = Yii::$app->request;

        if ($form->load($request->post())) {
            $validate = ActiveForm::validate($form);

            if (count($validate) > 0) {

                return $validate;
            } else {
                $model->setAttributes($form->attributes);
                $model->status = Comment::STATUS_NEW;
                $model->save(false);

                return ArrayHelper::merge($validate,
                    ['message' => Yii::t('app', 'Comment added and waiting for moderation')]);
            }
        }

        return null;
    }
}