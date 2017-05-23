<?php

namespace app\modules\pages\models;


use Yii;
use yii\helpers\Url;
use app\core\components\sitemap\SitemapModelInterface;

/**
 * This is the model class for table "mn_page".
 *
 * @property integer $id
 * @property string $name
 * @property string $content
 * @property integer $indexing
 * @property string $template
 * @property integer $site_id
 * @property string $alias
 * @property string $meta_title
 * @property string $meta_description
 * @property integer $create_time
 * @property integer $update_time
 */
class Page extends \app\core\db\ActiveRecord implements SitemapModelInterface
{
    const INDEXING_YES = 1;
    const INDEXING_NO = 0;

    protected $dynamicData;

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
            [['indexing', 'site_id'], 'integer'],
            [['content', 'dynamicData'], 'string'],
            [['name', 'template', 'alias', 'meta_title', 'meta_description'], 'string', 'max' => 255],
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
            'content' => Yii::t('app', 'Content'),
            'indexing' => Yii::t('app', 'Indexing'),
            'template' => Yii::t('pages', 'Template'),
            'dynamicData' => Yii::t('pages', 'Dynamic data'),
            'alias' => Yii::t('app', 'Alias'),
            'meta_title' => Yii::t('app', 'Meta title'),
            'meta_description' => Yii::t('app', 'Meta description'),
            'create_time' => Yii::t('app', 'Create time'),
            'update_time' => Yii::t('app', 'Update time'),
        ];
    }

    public function getModelItems()
    {
        return self::find()
            ->where(['indexing' => self::INDEXING_YES])
            ->all();
    }

    public function getModelItemUrl()
    {
        return Url::to(['/page/default/view', 'id' => $this->id], true);
    }

    public function getDynamicDataFilePathUrl()
    {
        return $file = Yii::$app->controller->module->dynamicDataPath . '/pageId_' . $this->id . '.php';
    }

    public function getDynamicData()
    {
        $file = $this->getDynamicDataFilePathUrl();
        return is_file($file) ? file_get_contents($file) : null;
    }
}
