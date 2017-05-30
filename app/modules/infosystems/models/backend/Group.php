<?php

namespace app\modules\infosystems\models\backend;


use Yii;
use yii\helpers\ArrayHelper;
use app\modules\infosystems\Module;

class Group extends \app\modules\infosystems\models\Group
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['image_preview', 'image'], 'image', 'extensions' => ['jpg', 'png', 'gif']],
            ['parent_id', 'compare', 'compareAttribute' => 'id', 'operator' => '!='],
            ['sorting', 'default', 'value' => Module::DEFAULT_SORTING],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            [
                ['image_preview'],
                'image',
                'maxWidth' => $this->infosystem->max_width_image_preview_group,
                'maxHeight' => $this->infosystem->max_height_image_preview_group
            ],
            [
                ['image'],
                'image',
                'maxWidth' => $this->infosystem->max_width_image_group,
                'maxHeight' => $this->infosystem->max_height_image_group
            ],
        ]);
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            [
                'class' => 'app\core\behaviors\GenerateAlias',
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

    public function getInfosystem()
    {
        return $this->hasOne(Infosystem::className(), ['id' => 'infosystem_id']);
    }

    public static function getSortingAttribute()
    {
        $attributes = ['id', 'name', 'create_time', 'update_time'];

        return array_combine($attributes, $attributes);
    }
}
