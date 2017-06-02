<?php

namespace app\modules\sites\models;

use Yii;

/**
 * This is the model class for table "{{%site}}".
 *
 * @property integer $id
 * @property string $domain
 * @property string $name
 * @property string $description
 * @property string $robots_txt
 * @property string $upload_dir
 * @property string $template_id
 * @property string $layout
 * @property integer $active
 */
class Site extends \yii\db\ActiveRecord
{
    const ACTIVE = 1;
    const NOT_ACTIVE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%site}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'robots_txt'], 'string'],
            [['active'], 'integer'],
            [['domain', 'name', 'template_id', 'layout'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'domain' => Yii::t('app', 'Domain'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'robots_txt' => Yii::t('app', 'Robots Txt'),
            'upload_dir' => Yii::t('sites', 'Upload dir'),
            'template_id' => Yii::t('app', 'Template'),
            'layout' => Yii::t('app', 'Layout'),
            'active' => Yii::t('app', 'Active'),
        ];
    }

    public function getTemplate()
    {
        return $this->hasOne(Template::className(), ['id' => 'template_id']);
    }
}
