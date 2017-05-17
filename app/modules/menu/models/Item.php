<?php

namespace app\modules\menu\models;


use Yii;
use app\core\behaviors\file\ActionImage;

/**
 * This is the model class for table "{{%menu_item}}".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property integer $menu_id
 * @property string $name
 * @property integer $name_hidden
 * @property integer $active
 * @property string $url
 * @property integer $visible
 * @property integer $sorting
 * @property string $image
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
    const ACTIVE = 1;
    const NOT_ACTIVE = 0;

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
            [['name',], 'required'],
            [['parent_id', 'name_hide', 'active', 'menu_id', 'visible', 'sorting'], 'integer'],
            [['name', 'url'], 'string', 'max' => 255],
            [['item_icon_class', 'item_class', 'item_id', 'link_class', 'link_id'], 'string', 'max' => 100],
            ['image', 'image'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'parent_id' => Yii::t('menu', 'Parent ID'),
            'menu_id' => Yii::t('menu', 'Menu ID'),
            'name' => Yii::t('app', 'Name'),
            'name_hide' => Yii::t('menu', 'Name hide'),
            'active' => Yii::t('app', 'Active'),
            'url' => Yii::t('app', 'Url'),
            'visible' => Yii::t('menu', 'Visible'),
            'sorting' => Yii::t('app', 'Sorting'),
            'image' => Yii::t('app', 'Image'),
            'item_class' => Yii::t('menu', 'CSS class item'),
            'item_icon_class' => Yii::t('menu', 'Item icon CSS class'),
            'item_id' => Yii::t('menu', 'HTML ID item'),
            'link_class' => Yii::t('menu', 'Link CSS class'),
            'link_id' => Yii::t('menu', 'Link HTML ID'),
        ];
    }

    public function behaviors()
    {
        return [
            'itemImage' => [
                'class' => ActionImage::className(),
                'attribute' => 'image',
                'path' => '@webroot/public/uploads/menu',
                'pathUrl' => '@web/public/uploads/menu',
            ],
        ];
    }

    public function getSubItems()
    {
        return $this->hasMany(self::className(), ['parent_id' => 'id']);
    }

    public function getMenu()
    {
        return $this->hasOne(Menu::className(), ['id' => 'menu_id']);
    }

    public function getStatusVisibleList()
    {
        return [
            self::STATUS_VISIBLE_ALL => Yii::t('menu', 'Menu visible all'),
            self::STATUS_VISIBLE_GUEST => Yii::t('menu', 'Menu visible guest'),
            self::STATUS_VISIBLE_NOT_GUEST => Yii::t('menu', 'Menu visible not guest'),
        ];
    }

    public function getStatusVisible($status)
    {
        return $this->getStatusVisibleList()[$status];
    }
}
