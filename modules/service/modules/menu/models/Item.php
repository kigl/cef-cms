<?php

namespace app\modules\service\modules\menu\models;

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
 * @property integer $sorting
 * @property string $item_class
 * @property string $item_id
 * @property string $item_icon_class
 * @property string $link_class
 * @property string $link_id
 */
class Item extends \yii\db\ActiveRecord
{
    const STATUS_VISIBLE_ALL = 0;
    const STATUS_VISIBLE_GUEST = 1;
    const STATUS_VISIBLE_NOT_GUEST = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%service_menu_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name',], 'required'],
            [['parent_id', 'menu_id', 'visible', 'sorting'], 'integer'],
            [['name', 'url'], 'string', 'max' => 255],
            [['item_icon_class', 'item_class', 'item_id', 'link_class', 'link_id'], 'string', 'max' => 100],
            ['sorting', 'default', 'value' => 500],
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
            'sorting' => Yii::t('app', 'Sorting'),
            'item_class' => Yii::t('service', 'CSS element class'),
            'item_icon_class' => Yii::t('service', 'Element icon CSS class'),
            'item_id' => Yii::t('service', 'Menu element id html'),
            'link_class' => Yii::t('service', 'Link class'),
            'link_id' => Yii::t('service', 'Link id html'),
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
