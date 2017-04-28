<?php

namespace app\modules\infosystem\models\backend;


use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "mn_infosystem_group".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $infosystem_id
 * @property string $name
 * @property string $description
 * @property string $content
 * @property string $image_1
 * @property string $image_2
 * @property integer $user_id
 * @property string $alias
 * @property string $meta_title
 * @property string $meta_description
 * @property integer $create_time
 * @property integer $update_time
 */
class Group extends \app\modules\infosystem\models\Group
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['image_1', 'image_2'], 'file', 'extensions' => ['jpg', 'png', 'gif']],
            ['parent_id', 'compare', 'compareAttribute' => 'id', 'operator' => '!='],
            ['sorting', 'default', 'value' => 500],
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

    public static function find()
    {
        return new GroupQuery(get_called_class());
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
