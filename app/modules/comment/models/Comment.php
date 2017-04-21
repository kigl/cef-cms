<?php

namespace app\modules\comment\models;


use Yii;
use kigl\cef\module\user\models\base\User;

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
class Comment extends \app\core\db\ActiveRecord
{

    const STATUS_BLOCK = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DRAFT = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%comment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'item_id', 'status', 'user_id'], 'integer'],
            [['content'], 'string'],
            [['create_time', 'update_time'], 'safe'],
            [['model_class'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'model_class' => Yii::t('app', 'Model class'),
            'item_id' => Yii::t('app', 'Item ID'),
            'content' => Yii::t('app', 'Content'),
            'status' => Yii::t('app', 'Status'),
            'user_id' => Yii::t('app', 'Author'),
            'create_time' => Yii::t('app', 'Create time'),
            'update_time' => Yii::t('app', 'Update time'),
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getAllStatus()
    {
        return [
            self::STATUS_BLOCK => Yii::t('app', 'Status block'),
            self::STATUS_ACTIVE => Yii::t('app', 'Status active'),
            self::STATUS_DRAFT => Yii::t('app', 'Status draft'),
        ];
    }

    public function getStatus($status)
    {
        return $this->getAllStatus()[$status];
    }
}
