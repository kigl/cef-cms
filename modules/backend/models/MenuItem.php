<?php

namespace app\modules\backend\models;

use Yii;

/**
 * This is the model class for table "{{%menu_item}}".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property integer $menu_id
 * @property string $name
 * @property string $url
 * @property integer $visible
 * @property string $class
 * @property string $icon_class
 * @property integer $position
 */
class MenuItem extends \yii\db\ActiveRecord
{
    const STATUS_VISIBLE_ALL = 0;
    const STATUS_VISIBLE_GUEST = 1;
    const STATUS_VISIBLE_NOT_GUEST = 2;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menu_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'url'], 'required'],
            [['parent_id', 'menu_id', 'visible', 'position'], 'integer'],
            [['name', 'url', 'icon_class'], 'string', 'max' => 255],
            [['class'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'Id'),
            'parent_id' => Yii::t('app', 'Parent id'),
            'menu_id' => Yii::t('backend', 'Menu Id'),
            'name' => Yii::t('app', 'Name'),
            'url' => Yii::t('app', 'Url'),
            'visible' => Yii::t('app', 'Visible'),
            'class' => Yii::t('app', 'CSS class'),
            'icon_class' => Yii::t('app', 'Icon css class'),
            'position' => Yii::t('app', 'Position'),
        ];
    }

    public function getSubItems()
    {
        return $this->hasMany(self::className(), ['parent_id' => 'id']);
    }

    public function getStatusVisibleList()
    {
        return [
            self::STATUS_VISIBLE_ALL => Yii::t('backend', 'Menu visible all'),
            self::STATUS_VISIBLE_GUEST => Yii::t('backend', 'Menu visible guest'),
            self::STATUS_VISIBLE_NOT_GUEST => Yii::t('backend', 'Menu visible not guest'),
        ];
    }

    public function getStatusVisible($status)
    {
        return $this->getStatusVisibleList()[$status];
    }
}
