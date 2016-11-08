<?php

namespace app\modules\informationsystem\models;

use Yii;
use app\modules\informationsystem\models\Item;
use app\modules\informationsystem\models\TagRelations;

/**
 * This is the model class for table "mn_tag".
 *
 * @property integer $id
 * @property integer informationsystem_id
 * @property string $name
 */
class Tag extends \app\core\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%informationsystem_item_tag}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            [['informationsystem_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('informationsystem', 'Tag id'),
            'name' => Yii::t('informationsystem', 'Tag name'),
            'informationsystem_id' => Yii::t('informationsystem', 'id'),
        ];
    }

    public function getItems()
    {
        return $this->hasMany(Item::className(), ['id' => 'item_id'])
            ->viaTable(TagRelations::tableName(), ['tag_id' => 'id']);
    }
}
