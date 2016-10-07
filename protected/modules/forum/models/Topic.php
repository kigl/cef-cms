<?php

namespace app\modules\forum\models;

use Yii;
use app\modules\user\models\User;

/**
 * This is the model class for table "mn_forum_topic".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property integer $user_id
 * @property integer $counter
 * @property integer $create_time
 * @property integer $update_time
 */
class Topic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mn_forum_topic';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        		['name', 'required'],
            [['parent_id', 'user_id', 'counter', 'create_time', 'update_time'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('forum', 'ID'),
            'parent_id' => Yii::t('forum', 'Parent ID'),
            'name' => Yii::t('forum', 'Name'),
            'user_id' => Yii::t('forum', 'User id'),
            'counter' => Yii::t('forum', 'Counter'),
            'countTopic' => Yii::t('forum', 'Count topic'),
            'countPost' => Yii::t('forum', 'Count post'),
            'create_time' => Yii::t('forum', 'Create time'),
            'update_time' => Yii::t('forum', 'Update time'),
        ];
    }
    
    public function getAuthor()
    {
			return $this->hasOne(User::className(), ['id' => 'user_id']);
		}
		
		public function getCountTopic()
		{
			return self::find()->where("parent_id = {$this->id}")->count();
		}
		
		public function getCountPost()
		{
			return Post::find()->where("topic_id = {$this->id}")->count() - 1;
		}
		
		public function behaviors()
		{
			return [
				[
					'class' => 'app\modules\main\components\behaviors\UserId',
				],
				[
					'class' => 'yii\behaviors\TimeStampBehavior',
					'createdAtAttribute' => 'create_time',
					'updatedAtAttribute' => 'update_time',
				],
			];
		}
		
		public static function updateCounter($id)
		{
			$model = self::findOne($id);
			return $model->updateCounters(['counter' => 1]);
		}
}
