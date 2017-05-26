<?php

namespace app\modules\infosystems\models\backend;

use Yii;
use app\modules\tag\components\TagBehavior;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Item extends \app\modules\infosystems\models\Item
{
    protected $_runtimeTags;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['image_description', 'image_content'], 'image', 'extensions' => ['jpg', 'png', 'gif']],
            ['sorting', 'default', 'value' => 500],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            [
                ['image_description'],
                'image',
                'maxWidth' => $this->infosystem->max_width_image_description_item,
                'maxHeight' => $this->infosystem->max_height_image_description_item
            ],
            [
                ['image_content'],
                'image',
                'maxWidth' => $this->infosystem->max_width_image_content_item,
                'maxHeight' => $this->infosystem->max_height_image_content_item
            ],
            ['listTags', 'safe'],
        ]);
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'convertDate' => [
                'class' => 'app\core\behaviors\ConvertDate',
                'attribute' => 'date',
            ],
            'convertDateStart' => [
                'class' => 'app\core\behaviors\ConvertDate',
                'attribute' => 'date_start',
            ],
            'convertDateEnd' => [
                'class' => 'app\core\behaviors\ConvertDate',
                'attribute' => 'date_end',
            ],
            [
                'class' => 'app\core\behaviors\FillData',
                'attribute' => 'create_time',
                'setAttribute' => 'date',
            ],
            [
                'class' => 'app\core\behaviors\FillData',
                'attribute' => 'name',
                'setAttribute' => 'meta_title',
            ],
            [
                'class' => 'app\core\behaviors\UserId',
                'attribute' => 'user_id',
            ],
            [
                'class' => 'app\core\behaviors\GenerateAlias',
                'text' => 'name',
                'alias' => 'alias',
            ],
        ]);
    }

    public function getItemProperties()
    {
        return $this->hasMany(ItemProperty::className(), ['item_id' => 'id']);
    }

    public static function getSortingAttribute()
    {
        $attributes = ['id', 'name', 'date', 'create_time', 'update_time'];

        return array_combine($attributes, $attributes);
    }

    public function setListTags($tags)
    {
        $this->_runtimeTags = empty($tags) ? [] : $tags;
    }


    public function getListTags()
    {
        return ArrayHelper::getColumn($this->tags, 'id');
    }


    public function getRuntimeTags()
    {
        return $this->_runtimeTags;
    }
}
