<?php

namespace app\modules\page\models\backend;


use Yii;
use app\core\behaviors\FillData;
use app\core\behaviors\GenerateAlias;
use yii\helpers\ArrayHelper;

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
class Page extends \app\modules\page\models\Page
{
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            ['template', 'default', 'value' => 'view'],
            ['indexing', 'default', 'value' => self::INDEXING_YES],
        ]);
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

    public function setDynamicData($data)
    {
        $this->dynamicData = $data;
    }

    protected function saveViewFile()
    {
        if ($this->dynamicData !== '') {
            file_put_contents($this->getDynamicDataFilePathUrl(), $this->dynamicData);
        } else {
            $this->deleteViewFile();
        }
    }

    protected function deleteViewFile()
    {
        $file = $this->getDynamicDataFilePathUrl();
        if (is_file($file)) {
            @unlink($file);
        }
    }
}
