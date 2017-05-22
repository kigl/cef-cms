<?php

namespace app\modules\infosystems\models\backend;


use Yii;
use yii\helpers\ArrayHelper;

class Group extends \app\modules\infosystems\models\Group
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['image_description', 'image_content'], 'image', 'extensions' => ['jpg', 'png', 'gif']],
            ['parent_id', 'compare', 'compareAttribute' => 'id', 'operator' => '!='],
            ['sorting', 'default', 'value' => 500],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            [
                ['image_description'],
                'image',
                'maxWidth' => $this->infosystem->max_width_image_description_group,
                'maxHeight' => $this->infosystem->max_height_image_description_group
            ],
            [
                ['image_content'],
                'image',
                'maxWidth' => $this->infosystem->max_width_image_content_group,
                'maxHeight' => $this->infosystem->max_height_image_content_group
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
