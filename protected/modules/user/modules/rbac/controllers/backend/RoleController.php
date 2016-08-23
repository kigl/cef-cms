<?php
namespace app\modules\user\modules\rbac\controllers\backend;

use Yii;
use app\modules\user\modules\rbac\models\Rbac;

class RoleController extends \app\modules\main\components\controllers\BackendController
{

	public function actionManager()
	{
		$model = new Rbac();
		
		return $this->render('manager', ['model' => $model]);
		
	}
}
?>