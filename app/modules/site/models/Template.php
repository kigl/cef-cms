<?php

namespace app\modules\site\models;

use Yii;

/**
 * This is the model class for table "{{%template}}".
 *
 * @property string $id
 * @property string $name
 * @property string $description
 * @property string $version
 */
class Template extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%template}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name', 'version'], 'required'],
            [['id', 'name', 'version'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'version' => Yii::t('app', 'Version'),
        ];
    }
}
