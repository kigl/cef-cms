<?php

namespace app\modules\user\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%user_setting}}".
 *
 * @property integer $id
 * @property integer $register_status
 * @property string $register_group
 * @property integer $avatar_width
 * @property integer $avatar_height
 */
class Setting extends \app\core\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_setting}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['register_status',], 'required'],
            [['register_status', 'avatar_width', 'avatar_height'], 'integer'],
            [['register_group'], 'string', 'max' => 255],
            [['avatar_width', 'avatar_height'], 'default', 'value' => 600],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'register_status' => Yii::t('user', 'Setting.register status'),
            'register_group' => Yii::t('user', 'Setting.register group'),
            'avatar_width' => Yii::t('user', 'Setting.avatar width'),
            'avatar_height' => Yii::t('user', 'Setting.avatar height'),
        ];
    }

    public function getListStatus()
    {
        return (new User)->getStatusList();
    }

    public function getAuthItem()
    {
        $manager = Yii::$app->authManager->getRoles();
        $result = ArrayHelper::map($manager, 'name', 'name');

        return $result;
    }
}
