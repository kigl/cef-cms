<?php

namespace app\modules\main\models;

use Yii;

/**
 * This is the model class for table "mn_module".
 *
 * @property string $id
 * @property string $name
 * @property string $description
 */
class Module extends \app\modules\main\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mn_module';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name', 'description'], 'required'],
            [['id'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'ID'),
            'name' => Yii::t('main', 'Name'),
            'description' => Yii::t('main', 'Description'),
        ];
    }

    public static function getList()
    {
        $model = self::find()->all();
        $result = [];
        foreach ($model as $module) {
            $result[$module->id] = $module->name;
        }

        return $result;
    }
    
  public static function getModuleName()
	{
		$model = self::findOne(['id' => Yii::$app->controller->module->id]);
		if ($model) {
			return $model->name;
		} else {
			throw new \yii\web\HttpException('404');
		}
	}
}
