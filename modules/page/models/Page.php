<?php

namespace app\modules\page\models;


use app\core\behaviors\GenerateAlias;
use Yii;

/**
 * This is the model class for table "mn_page".
 *
 * @property integer $id
 * @property string $name
 * @property string $content
 * @property string $alias
 * @property string $meta_title
 * @property string $meta_description
 * @property integer $create_time
 * @property integer $update_time
 */
class Page extends \app\core\db\ActiveRecord
{
    protected $fileData;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%page}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['content', 'alias'], 'string'],
            [['name', 'meta_title', 'meta_description'], 'string', 'max' => 255],
            ['viewFile', 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('page', 'Id'),
            'name' => Yii::t('page', 'Name'),
            'content' => Yii::t('page', 'Content'),
            'alias' => Yii::t('app', 'Alias'),
            'meta_title' => Yii::t('app', 'Meta title'),
            'meta_description' => Yii::t('app', 'Meta description'),
            'create_time' => Yii::t('app', 'Create time'),
            'update_time' => Yii::t('app', 'Update time'),
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => GenerateAlias::class,
                'text' => 'name',
                'alias' => 'alias',
            ]
        ];
    }

    protected function getViewFilePathUrl()
    {
        return $file = Yii::$app->controller->module->getViewFilesPathUrl() . '/' . $this->id . '.php';
    }

    public function getViewFile()
    {
        $file = $this->getViewFilePathUrl();
        return is_file($file)? file_get_contents($file) : null;
    }

    public function setViewFile($data)
    {
        $this->fileData = $data;
    }

    public function beforeSave($insert)
    {
        file_put_contents($this->getViewFilePathUrl(), $this->fileData);

        return parent::beforeSave($insert);
    }
}
