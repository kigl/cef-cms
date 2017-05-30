<?php

namespace app\modules\pages\models\backend;


use Yii;
use yii\helpers\ArrayHelper;
use app\modules\infosystems\models\Infosystem;
use app\modules\shop\models\Shop;
use app\core\behaviors\FillData;
use app\core\behaviors\GenerateAlias;

class Page extends \app\modules\pages\models\Page
{
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [
                'code',
                'unique',
                'targetClass' => Shop::className(),
                'targetAttribute' => 'code',
            ],
            [
                'code',
                'unique',
                'targetClass' => Infosystem::className(),
                'targetAttribute' => 'code',
            ],
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
