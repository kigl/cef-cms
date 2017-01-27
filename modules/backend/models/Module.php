<?php

namespace app\modules\backend\models;

use Yii;

/**
 * This is the model class for table "mn_module".
 *
 * @property string $id
 * @property string $name
 * @property string $description
 */
class Module extends \yii\base\Model
{

	public function attributeLabels	()
	{
		return [
			'id' => Yii::t('admin', 'Id'),
			'module_id' => Yii::t('admin', 'Module id'),
			'name' => Yii::t('admin', 'Name setting'),
			'label' => Yii::t('admin', 'Label'),
			'views' => Yii::t('admin', 'Value'),
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
