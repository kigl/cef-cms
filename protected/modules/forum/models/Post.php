<?php

namespace app\modules\forum\models;

use Yii;
use app\modules\forum\models\Topic;
use app\modules\user\models\User;

/**
 * This is the model class for table "mn_forum_post".
 *
 * @property integer $id
 * @property integer $topic_id
 * @property string $content
 * @property integer $user_id
 * @property integer $create_time
 * @property integer $update_time
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mn_forum_post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        		['content', 'required'],
            [['topic_id', 'user_id', 'create_time', 'update_time'], 'integer'],
            [['content'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('forum', 'ID'),
            'topic_id' => Yii::t('forum', 'Topic ID'),
            'content' => Yii::t('forum', 'Content'),
            'user_id' => Yii::t('forum', 'User ID'),
            'create_time' => Yii::t('forum', 'Create Time'),
            'update_time' => Yii::t('forum', 'Update Time'),
        ];
    }
    
    public function getAuthor()
    {
			return $this->hasOne(User::className(), ['id' => 'user_id']);
		}
		
		public function getTopic()
		{
			return $this->hasOne(Topic::className(), ['id' => 'topic_id']);
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
}
