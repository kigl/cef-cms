<?php
/**
 * Class OrderFroms
 * @package app\modules\shop\models\forms
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\models\forms;


use Yii;
use yii\base\Model;

class OrderForm extends Model
{
    public $country;

    public $region;

    public $city;

    public $postcode;

    public $address;

    public $company;

    public $phone;

    public $comment;

    public function rules()
    {
        return [
            [['country', /*'city', 'address', 'postcode'*/], 'required'],
            ['postcode', 'integer'],
            [['country', 'region', 'city', 'address', 'company', 'comment', 'phone'], 'string', 'max' => 255],
        ];
    }
/*
    public function attributes()
    {
        return [
            'country' => Yii::t('shop', 'Country'),
            'region' => Yii::t('shop', 'Region'),
            'city' => Yii::t('shop', 'City'),
            'postcode' => Yii::t('shop', 'Postcode'),
            'address' => Yii::t('shop', 'Address'),
            'company' => Yii::t('shop', 'Company'),
            'phone' => Yii::t('shop', 'Phone'),
            'comment' => Yii::t('shop', 'Comment'),
        ];
    }
*/
}