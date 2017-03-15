<?php
/**
 * Class RbacForm
 * @package app\modules\user\models
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */

namespace kigl\cef\module\user\models\forms;


use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\rbac\Item;
use yii\db\Query;
use yii\rbac\Role;
use kartik\alert\Alert;

class RbacForm extends Model
{
    public $name;

    public $child = [];

    public $type;

    public $description;

    public $ruleName;

    public $data;

    public $item = null;

    public function init()
    {
        $this->on(self::EVENT_BEFORE_VALIDATE, function ($event) {
            Yii::$app->session->setFlash(Alert::TYPE_SUCCESS, Yii::t('app', 'Created element'));
        });

        parent::init();
    }

    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['name', 'description', 'ruleName'], 'string', 'max' => 255],
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

    public function getItems()
    {
        $query = new Query;
        $query->from('{{%auth_item}}')
            ->orderBy(['type' => SORT_ASC])
            ->select(['name', 'type'])
            ->all();

        return ArrayHelper::map($query->all(), 'name', 'name', 'type');
    }

    public function getListType()
    {
        return [
            Role::TYPE_ROLE => Yii::t('app', 'Type role'),
            Role::TYPE_PERMISSION => Yii::t('app', 'Type permission'),
        ];
    }

    public function getType($type)
    {
        return $this->getListType()[$type];
    }
}
