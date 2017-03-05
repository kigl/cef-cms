<?php

namespace app\modules\page\models;


use Yii;
use yii\helpers\Url;
use app\core\behaviors\FillData;
use app\core\behaviors\GenerateAlias;
use app\core\components\sitemap\SitemapModelInterface;
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
class Page extends \app\core\db\ActiveRecord implements SitemapModelInterface
{
    protected $dynamicPageData;

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
            ['dynamicPage', 'safe'],
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
            'dynamicPage' => Yii::t('page', 'Dynamic page'),
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
            ],
            [
                'class' => FillData::class,
                'attribute' => 'name',
                'setAttribute' => 'meta_title',
            ],
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->saveViewFile();

        return parent::afterSave($insert, $changedAttributes);
    }

    public function afterDelete()
    {
        $this->deleteViewFile();

        return parent::afterDelete();
    }

    public function getDynamicPageFileUrl()
    {
        return $file = Yii::$app->controller->module->getDynamicPagePath() . '/pageId_' . $this->id . '.php';
    }

    public function getDynamicPage()
    {
        $file = $this->getDynamicPageFileUrl();
        return is_file($file) ? file_get_contents($file) : null;
    }

    public function setDynamicPage($data)
    {
        $this->dynamicPageData = $data;
    }

    protected function saveViewFile()
    {
        if ($this->dynamicPageData !== '') {
            file_put_contents($this->getDynamicPageFileUrl(), $this->dynamicPageData);
        } else {
            $this->deleteViewFile();
        }
    }

    protected function deleteViewFile()
    {
        $file = $this->getDynamicPageFileUrl();
        if (is_file($file)) {
            unlink($file);
        }
    }

    public function getModelItems()
    {
        return self::find()
            ->all();
    }

    public function getModelItemUrl()
    {
        return Url::to(['/page/default/view', 'id' => $this->id]);
    }
}
