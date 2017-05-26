<?php

namespace app\modules\shop\models\backend;


use app\core\behaviors\GenerateAlias;
use yii\helpers\ArrayHelper;

class Group extends \app\modules\shop\models\Group
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['image_preview', 'image'], 'image', 'extensions' => ['jpg']],
            ['parent_id', 'compare', 'compareAttribute' => 'id', 'operator' => '!='],
        ]);
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            [
                'class' => GenerateAlias::class,
                'text' => 'name',
                'alias' => 'alias',
            ],
            [
                'class' => 'app\core\behaviors\FillData',
                'attribute' => 'name',
                'setAttribute' => 'meta_title',
            ],
        ]);
    }
}
