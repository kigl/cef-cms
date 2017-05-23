<?php
/**
 * Class RbacForm
 * @package app\modules\user\models
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */

namespace app\modules\users\models\backend\forms;


use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\rbac\Item;
use yii\db\Query;
use yii\rbac\Role;

class RbacForm extends Model
{
    public $name;

    public $child = [];

    public $type;

    public $description;

    public $ruleName;

    public $data;

    public $item = null;

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
        if ($this->{$attribute} == Item::TYPE_ROLE) {
            $this->{$attribute} = Item::TYPE_ROLE;
        } else {
            if ($this->{$attribute} == Item::TYPE_PERMISSION) {
                $this->{$attribute} = Item::TYPE_PERMISSION;
            } else {
                $this->addError($attribute, Yii::t('users', 'Rbac form error message type'));
            }
        }
    }

    public function attributeLabels()
    {
        return [
            'name' => Yii::t('users', 'Rbac form name'),
            'child' => Yii::t('users', 'Rbac form child'),
            'type' => Yii::t('users', 'Rbac form type'),
            'description' => Yii::t('users', 'Rbac form description'),
            'ruleName' => Yii::t('users', 'Rule name'),
        ];
    }

    /**
     * @todo
     * убрать из модели формы?
     * @return array
     */
    public function getItems()
    {
        $query = new Query;
        $query->from('{{%auth_item}}')
            ->orderBy(['type' => SORT_ASC])
            ->select(['name', 'type'])
            ->indexBy('name');

        $result = $query->all();

        unset($result[$this->name]);

        return ArrayHelper::map($result, 'name', 'name', 'type');
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
