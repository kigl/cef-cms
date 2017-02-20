<?php

namespace app\modules\infosystem\models;

use Yii;

/**
 * This is the model class for table "mn_tag".
 *
 * @property integer $id
 * @property integer infosystem_id
 * @property string $name
 */
class Tag extends \app\core\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%infosystem_element_tag}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            [['infosystem_id'], 'integer'],
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
            'infosystem_id' => Yii::t('infosystem', 'id'),
        ];
    }

    public function getInfosystem()
    {
        return $this->hasOne(Infosystem::className(), ['id' => 'infosystem_id']);
    }

    public function getElements()
    {
        return $this->hasMany(Element::className(), ['id' => 'element_id'])
            ->viaTable(ElementTag::tableName(), ['tag_id' => 'id']);
    }

    public static function find()
    {
        return new ElementQuery(get_called_class());
    }
}
