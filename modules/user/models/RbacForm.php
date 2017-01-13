<?php
/**
 * Class RbacForm
 * @package app\modules\user\models
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\user\models;


use Yii;
use yii\base\Model;
use yii\rbac\Item;
use app\core\session\Flash;

class RbacForm extends Model
{
    public $name;

    public $child = [];

    public $type;

    public $description;

    public $rule;

    public $data;

    public $item = null;

    public function init()
    {
        $this->on(self::EVENT_BEFORE_VALIDATE, function ($event) {
            Yii::$app->session->setFlash(Flash::FLASH_SUCCESS, Yii::t('app', 'Created element'));
        });

        parent::init();
    }

    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['name', 'description'], 'string', 'max' => 255],
            ['type', 'validatorType'],
            ['child', 'safe'],
        ];
    }

    public function validatorType($attribute)
    {
        if ($this->$attribute == Item::TYPE_ROLE) {
            $this->$attribute = Item::TYPE_ROLE;
        } else {
            if ($this->$attribute == Item::TYPE_PERMISSION) {
                $this->$attribute = Item::TYPE_PERMISSION;
            } else {
                $this->addError($attribute, Yii::t('user', 'Rbac form error message type'));
            }
        }
    }

    public function attributeLabels()
    {
        return [
            'name' => Yii::t('user', 'Rbac form name'),
            'child' => Yii::t('user', 'Rbac form child'),
            'type' => Yii::t('user', 'Rbac form type'),
            'description' => Yii::t('user', 'Rbac form description'),
        ];
    }
}
