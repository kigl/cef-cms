<?php

namespace app\modules\shop\models\backend;


use app\core\behaviors\GenerateAlias;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "mn_shop_group".
 *
 * @property integer $id
 * @property integer $group_id
 * @property string $name
 * @property string $description
 * @property string $content
 * @property string $image
 * @property string $image_small
 * @property integer $user_id
 * @property string $create_time
 * @property string $update_time
 */
class Group extends \app\modules\shop\models\Group
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['image_1', 'image_2'], 'image', 'extensions' => ['jpg']],
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
