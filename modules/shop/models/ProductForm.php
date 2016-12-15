<?php

namespace app\modules\shop\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "mn_shop_product".
 *
 * @property integer $id
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
class ProductForm extends Model
{
    public $name;
    public $group_id;
    public $user_id;
    public $description;
    public $content;
    public $price;
    public $sku;
    public $status;
    public $create_time;
    public $update_time;
    public $code;
    public $alias;
    public $meta_title;
    public $meta_description;
    public $imageUpload;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['group_id', 'sku', 'status', 'user_id'], 'integer'],
            [['content'], 'string'],
            [['price'], 'number'],
            [['create_time', 'update_time'], 'safe'],
            [['code', 'name', 'description', 'alias', 'meta_title', 'meta_description'], 'string', 'max' => 255],
            ['imageUpload', 'image', 'maxFiles' => 5],
        ];
    }
}
