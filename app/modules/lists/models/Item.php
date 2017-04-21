<?php

namespace app\modules\lists\models;


use Yii;

/**
 * This is the model class for table "{{%list_item}}".
 *
 * @property integer $id
 * @property integer $list_id
 * @property string $value
 * @property string $description
 * @property integer $sorting
 *
 * @property Lists $list
 */
class Item extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%list_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['value', 'required'],
            [['list_id'], 'integer'],
            ['value', 'unique'],
            [['value'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'list_id' => Yii::t('app', 'List ID'),
            'value' => Yii::t('app', 'Value'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLists()
    {
        return $this->hasOne(Lists::className(), ['id' => 'list_id']);
    }
}
