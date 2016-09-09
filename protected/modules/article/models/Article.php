<?php

namespace app\modules\article\models;

use Yii;
use app\modules\user\models\User;

/**
 * This is the model class for table "mn_page".
 *
 * @property integer $id
 * @property integer $author
 * @property string $url
 * @property string $title
 * @property string $content
 * @property string $meta_title
 * @property string $meta_description
 */
class Article extends \yii\db\ActiveRecord
{
	
	    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mn_article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['content', 'meta_title', 'meta_description'], 'string'],
            [['url', 'title', 'meta_title'], 'string', 'max' => 255],
            [['url'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'ID'),
            'author_id' => Yii::t('main', 'Author'),
            'url' => Yii::t('main', 'Url'),
            'title' => Yii::t('main', 'Title'),
            'content' => Yii::t('main', 'Content'),
            'meta_title' => Yii::t('main', 'Meta Title'),
            'meta_description' => Yii::t('main', 'Meta Description'),
        ];
    }
    
    public function getAuthor()
    {
			return $this->hasOne(User::className(), ['id' => 'author_id']);
		}

    public function behaviors()
    {
        return [
            'fillData' => [
                'class' => 'app\modules\main\components\behaviors\FillData',
                'fillingUp' => 'title',
                'filling' => 'meta_title',
            ],
            	'fillUrl' => [
                'class' => 'app\modules\main\components\behaviors\UrlFillTranslitText',
                'text' => 'title',
                'url' => 'url',
            ],
        ];
    }
}
