<?php

namespace kigl\cef\module\service\models\lists;


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
            [['list_id', 'sorting'], 'integer'],
            [['value', 'description'], 'string', 'max' => 255],
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
            'description' => Yii::t('app', 'Description'),
            'sorting' => Yii::t('app', 'Sorting'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getList()
    {
        return $this->hasOne(Lists::className(), ['id' => 'list_id']);
    }
}
