<?php

namespace app\modules\shop\models;


use Yii;
use app\modules\sites\models\backend\Site;

/**
 * This is the model class for table "{{%shop_measure}}".
 *
 * @property integer $id
 * @property integer $site_id
 * @property string $name
 * @property string $description
 * @property string $code
 *
 * @property Shop[] $shops
 * @property Shop[] $shops0
 * @property Site $site
 */
class Measure extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shop_measure}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['site_id'], 'integer'],
            [['name', 'description', 'code'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'site_id' => Yii::t('app', 'Site ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'code' => Yii::t('app', 'Code'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSite()
    {
        return $this->hasOne(Site::className(), ['id' => 'site_id']);
    }
}
