<?php

namespace app\modules\tag\models;

use Yii;

/**
 * This is the model class for table "mn_tag".
 *
 * @property integer $id
 * @property string $name
 */
class Tag extends \app\core\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tag}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Tag id'),
            'name' => Yii::t('app', 'Tag name'),
        ];
    }

    /*
    public function getItems()
    {
        return $this->hasMany(Item::className(), ['id' => 'item_id'])
            ->viaTable(ItemTag::tableName(), ['tag_id' => 'id']);
    }
    */

    public static function find()
    {
        return new TagQuery(get_called_class());
    }
}
