<?php

namespace app\modules\user\models\backend;


use Yii;
use yii\helpers\ArrayHelper;
use app\modules\user\components\RbacService;
/**
 * This is the model class for table "mn_user".
 *
 * @property integer $id
 * @property string $login
 * @property string $surname
 * @property string $name
 * @property string $lastname
 * @property string $email
 * @property string $avatar
 * @property string $password
 * @property integer $status
 * @property integer $create_time
 * @property string $ip
 */
class User extends \app\modules\user\models\User
{
    /**
     * Виртуальное поле, не сохраняется в текущую db
     * Используется для отображения ролей и сохраниния связей в authManager
     * @var
     */
    public $rolePermission;

    public $password_repeat;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            ['password_repeat', 'string'],
            ['password', 'compare',  'message' => Yii::t('user', 'Message: password do not match')],
            ['rolePermission', 'safe'],
        ]);
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'userIp' => [
                'class' => 'app\core\behaviors\UserIp',
                'attribute' => 'ip',
            ],
        ]);
    }

    public function beforeSave($insert)
    {
        if ($this->password === '') {
            $this->password = $this->getOldAttribute('password');
        } else {
            $this->password = Yii::$app->security->generatePasswordHash($this->password);
        }

        return parent::beforeSave($insert);
    }

    public static function find()
    {
        return new UserQuery(get_called_class());
    }

    public function getListRoleItem()
    {
        return ArrayHelper::map(
            (new RbacService())->getItems(),
            'name', 'name', 'type'
        );
    }

    public function getProperties()
    {
        return $this->hasMany(PropertyRelation::className(), ['user_id' => 'id']);
    }
}
