<?php

namespace app\modules\comment\models\backend;


use Yii;
use kigl\cef\core\behaviors\UserId;
use kigl\cef\module\user\models\User;

/**
 * This is the model class for table "{{%comment}}".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $model_class
 * @property integer $item_id
 * @property string $content
 * @property integer $status
 * @property integer $user_id
 * @property string $create_time
 * @property string $update_time
 */
class Comment extends \app\modules\comment\models\Comment
{
    /**
     * @inheritdoc
     * @return CommentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CommentQuery(get_called_class());
    }
}
