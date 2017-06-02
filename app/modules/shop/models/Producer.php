<?php

namespace app\modules\shop\models;


use Yii;
use app\core\behaviors\file\ActionImage;

/**
 * This is the model class for table "{{%shop_producer}}".
 *
 * @property integer $id
 * @property integer $shop_id
 * @property integer $group_id
 * @property integer $sorting
 * @property string $name
 * @property string $description
 * @property string $content
 * @property string $image_preview
 * @property string $image
 * @property string $phone
 * @property string $address
 * @property string $fax
 * @property string $site
 * @property string $email
 * @property integer $tin
 * @property integer $kpp
 * @property integer $psrn
 * @property integer $okpo
 * @property integer $okved
 * @property integer $bik
 * @property integer $account_number
 * @property string $bank_name
 * @property string $bank_address
 * @property string $alias
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keyword
 * @property string $create_time
 * @property string $update_time
 *
 * @property Product[] $shopProducts
 */
class Producer extends \app\core\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shop_producer}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                ['shop_id', 'group_id', 'sorting', 'tin', 'kpp', 'psrn', 'okpo', 'okved', 'bik', 'account_number'],
                'integer'
            ],
            [['content'], 'string'],
            [['create_time', 'update_time'], 'safe'],
            [
                [
                    'name',
                    'address',
                    'phone',
                    'fax',
                    'site',
                    'email',
                    'bank_name',
                    'bank_address',
                    'alias',
                    'meta_title',
                    'meta_description',
                    'meta_keyword'
                ],
                'string',
                'max' => 255
            ],
            [['description'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'shop_id' => Yii::t('app', 'Shop ID'),
            'group_id' => Yii::t('app', 'Group ID'),
            'sorting' => Yii::t('app', 'Sorting'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'content' => Yii::t('app', 'Content'),
            'image_preview' => Yii::t('app', 'Image preview'),
            'image' => Yii::t('app', 'Image'),
            'address' => Yii::t('app', 'Address'),
            'phone' => Yii::t('app','Phone'),
            'fax' => Yii::t('app', 'Fax'),
            'site' => Yii::t('app', 'Site'),
            'email' => Yii::t('app', 'Email'),
            'tin' => Yii::t('app', 'Tin'),
            'kpp' => Yii::t('app', 'Kpp'),
            'psrn' => Yii::t('app', 'Psrn'),
            'okpo' => Yii::t('app', 'Okpo'),
            'okved' => Yii::t('app', 'Okved'),
            'bik' => Yii::t('app', 'Bik'),
            'account_number' => Yii::t('app', 'Account number'),
            'bank_name' => Yii::t('app', 'Bank name'),
            'bank_address' => Yii::t('app', 'Bank address'),
            'alias' => Yii::t('app', 'Alias'),
            'meta_title' => Yii::t('app', 'Meta title'),
            'meta_description' => Yii::t('app', 'Meta description'),
            'meta_keyword' => Yii::t('app', 'Meta keywords'),
            'create_time' => Yii::t('app', 'Create time'),
            'update_time' => Yii::t('app', 'Update time'),
        ];
    }

    public function behaviors()
    {
        return [
            'imagePreview' => [
                'class' => ActionImage::className(),
                'path' => Yii::$app->site->getUploadPath(true) . '/shop/producer',
                'pathUrl' => Yii::$app->site->getUploadPathUrl(true) . '/shop/producer',
                'attribute' => 'image_preview',
            ],
            'image' => [
                'class' => ActionImage::className(),
                'path' => Yii::$app->site->getUploadPath(true) . '/shop/producer',
                'pathUrl' => Yii::$app->site->getUploadPathUrl(true) . '/shop/producer',
                'attribute' => 'image',
            ],
        ];
    }

    public function getShop()
    {
        return $this->hasOne(Shop::className(), ['id' => 'shop_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['producer_id' => 'id']);
    }
}
