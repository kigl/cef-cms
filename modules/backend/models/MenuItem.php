<?php

namespace app\modules\backend\models;

use Yii;

/**
 * This is the model class for table "{{%menu_item}}".
 *
 * @property integer $id
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
            [['menu_id', 'visible', 'position'], 'integer'],
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
            'id' => Yii::t('backend', 'ID'),
            'menu_id' => Yii::t('backend', 'Menu ID'),
            'name' => Yii::t('backend', 'Name'),
            'url' => Yii::t('backend', 'Url'),
            'visible' => Yii::t('backend', 'Visible'),
            'class' => Yii::t('backend', 'Class'),
            'icon_class' => Yii::t('backend', 'Icon Class'),
            'position' => Yii::t('backend', 'Position'),
        ];
    }
}
