<?php

namespace app\modules\user\modules\rbac\models;

use Yii;

class Rbac extends \yii\base\Model 
{
	
	public $name;
	public $type;
	public $description;
	
	public function rules()
	{
		return [
			[['name', 'description'], 'require'],
		];
	}
	
	public function add($model)
	{
		Yii::$app->authManager->add($model);
	}
	
	public function getRoles()
	{
		foreach (Yii::$app->authManager->getRoles() as $role) {
			$result[$role->name] = $role->name;
		}
		return $result;
	}
}

?>