<?php

namespace app\modules\infosystem\models;


use Yii;

/**
 * This is the model class for table "mn_infosystem_element_tag".
 *
 * @property integer $model_id
 * @property integer $tag_id
 */
class ItemTag extends \app\core\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%infosystem_item_tag}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tag_id', 'item_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item_id' => Yii::t('main', 'Model ID'),
            'tag_id' => Yii::t('main', 'Tag ID'),
        ];
    }

    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['id' => 'tag_id']);
    }
}
