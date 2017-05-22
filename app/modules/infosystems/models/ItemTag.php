<?php

namespace app\modules\infosystems\models;


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
            'item_id' => Yii::t('app', 'Model ID'),
            'tag_id' => Yii::t('app', 'Tag ID'),
        ];
    }

    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['id' => 'tag_id']);
    }

    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id']);
    }
}
