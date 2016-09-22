<?php

namespace app\modules\informationsystem\models;

use Yii;
use app\modules\informationsystem\models\InformationsystemItem as Item;
use app\modules\informationsystem\models\TagRelations;

/**
 * This is the model class for table "mn_tag".
 *
 * @property integer $id
 * @property integer informationsystem_id
 * @property string $name
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mn_informationsystem_item_tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        		['name', 'required'],
            [['informationsystem_id'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'ID'),
            'name' => Yii::t('main', 'Name'),
            'informationsystem_id' => Yii::t('main', 'Informationsystem id'),
        ];
    }
    
    public function getItems()
    {
			return $this->hasMany(Item::className(), ['id' => 'item_id'])
								->viaTable(TagRelations::tableName(), ['tag_id' => 'id']);
		}
}
