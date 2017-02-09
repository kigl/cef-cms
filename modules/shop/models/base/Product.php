<?php

namespace app\modules\shop\models\base;

use Yii;
use yii\helpers\ArrayHelper;
use app\core\db\ActiveRecord;
use app\core\behaviors\GenerateAlias;
use yii\helpers\Html;

/**
 * This is the model class for table "mn_shop_product".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property integer $group_id
 * @property string $code
 * @property string $name
 * @property string $description
 * @property string $content
 * @property integer $sku
 * @property string $price
 * @property integer $user_id
 * @property string $create_time
 * @property string $update_time
 */
class Product extends ActiveRecord
{
    public $imageUpload;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shop_product}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['group_id', 'sku', 'status', 'user_id'], 'integer'],
            ['parent_id', 'exist', 'targetAttribute' => 'id'],
            [['content'], 'string'],
            [['price', 'sku'], 'default', 'value' => 0],
            [['price'], 'number'],
            [['code', 'name', 'description', 'alias', 'meta_title', 'meta_description'], 'string', 'max' => 255],
            ['imageUpload', 'image', 'maxFiles' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('shop', 'Id'),
            'parent_id' => Yii::t('shop', 'Product parent id'),
            'group_id' => Yii::t('shop', 'Group id'),
            'code' => Yii::t('shop', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'content' => Yii::t('app', 'Content'),
            'sku' => Yii::t('shop', 'Depot'),
            'price' => Yii::t('shop', 'Price'),
            'status' => Yii::t('shop', 'Status'),
            'user_id' => Yii::t('shop', 'User id'),
            'alias' => Yii::t('app', 'Alias'),
            'meta_title' => Yii::t('app', 'Meta title'),
            'meta_description' => Yii::t('app', 'Meta description'),
            'create_time' => Yii::t('app', 'Create time'),
            'update_time' => Yii::t('app', 'Update time'),
            'imageUpload' => Yii::t('shop', 'Image upload'),
            'groupName' => Yii::t('shop', 'Group name'),
        ];
    }
}
