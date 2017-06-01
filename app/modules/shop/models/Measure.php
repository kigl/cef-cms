<?php

namespace app\modules\shop\models;


use Yii;
use app\core\db\ActiveRecord;
use app\modules\sites\models\backend\Site;

/**
 * This is the model class for table "{{%shop_measure}}".
 *
 * @property integer $id
 * @property integer $site_id
 * @property string $short_name
 * @property string $name
 * @property string $code
 *
 * @property Shop[] $shops
 * @property Shop[] $shops0
 * @property Site $site
 */
class Measure extends ActiveRecord
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
            [['name', 'short_name', 'code'], 'string', 'max' => 255],
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
            'short_name' => Yii::t('app', 'Short name'),
            'name' => Yii::t('app', 'Name'),
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
