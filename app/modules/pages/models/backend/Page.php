<?php

namespace app\modules\pages\models\backend;


use Yii;
use app\core\behaviors\FillData;
use app\core\behaviors\GenerateAlias;
use yii\helpers\ArrayHelper;

class Page extends \app\modules\pages\models\Page
{
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            ['template', 'default', 'value' => 'view'],
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

    public function beforeSave($insert)
    {
        $this->site_id = Yii::$app->site->getId();

        return parent::beforeSave($insert);
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
