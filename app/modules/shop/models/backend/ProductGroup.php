<?php

namespace app\modules\shop\models\backend;


use yii\helpers\ArrayHelper;
use app\core\behaviors\GenerateAlias;

class ProductGroup extends \app\modules\shop\models\ProductGroup
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
