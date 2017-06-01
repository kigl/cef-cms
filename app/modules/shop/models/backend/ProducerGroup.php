<?php
/**
 * Class ProducerGroup
 * @package app\modules\shop\models\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\models\backend;


use yii\helpers\ArrayHelper;
use app\core\behaviors\GenerateAlias;
use app\modules\shop\Module;

class ProducerGroup extends \app\modules\shop\models\ProducerGroup
{
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['name'], 'required'],
            ['parent_id', 'compare', 'compareAttribute' => 'id', 'operator' => '!='],
            [['image_preview', 'image'], 'image'],
            ['sorting', 'default', 'value' => Module::DEFAULT_SORTING],
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