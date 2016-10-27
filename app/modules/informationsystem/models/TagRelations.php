<?php

namespace app\modules\informationsystem\models;

use Yii;

/**
 * This is the model class for table "mn_tag_relations".
 *
 * @property integer $model_id
 * @property integer $tag_id
 */
class TagRelations extends \app\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%informationsystem_item_tag_relation}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tag_id', 'item_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item_id' => Yii::t('main', 'Model ID'),
            'tag_id' => Yii::t('main', 'Tag ID'),
        ];
    }
}
