<?php

namespace app\modules\informationsystem\controllers;

use Yii;
use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use Imagine\Image\ImageInterface;
use app\modules\informationsystem\models\Informationsystem as System;
use app\modules\informationsystem\models\InformationsystemItem as Item;

class ImageController extends \app\modules\informationsystem\controllers\FrontentControllerAbstract
{
	public $systemId = 'image';
	
	public function actionThumbnail($id)
	{
		$response = Yii::$app->getResponse();
		$response->headers->set('Content-Type', 'image/jpg');
		$response->format = \yii\web\Response::FORMAT_RAW;
		
		$model = Item::find()->select(['id' ,'image'])->where('id = :id', [':id' => $id])->one();
		
		$image = new Imagine;
		
		$response->stream = $image->open($model->getBehavior('imageUpload')->getFileUrl())
													->resize(new Box(350, 233))
													->show('jpg');
		
		return $response->send();
	}
	
	public function actionView($id)
	{
		$model = Item::findOne($id);
		
		return $this->renderPartial('view', ['model' => $model]);
	}
	
	/**
	*	Строит путь с вложениями для виджета Breadcrumbs
	* @param integer $id
	* 
	* @return array | false
	*/
	public static function buildBreadcrumbs($id = null, $informationsystem_id)
	{
		$modelSystem = System::getSystem($informationsystem_id);

		$result[] = [
			'label' => $modelSystem->name,
			'url' => ['image/manager'],
		];
		
		if ($id !== null and $breadcrumbs = parent::recursive($id)) {
			$c = count($breadcrumbs) - 1;
			$breadcrumbs[$c]['span'] = 1;
			
			foreach ($breadcrumbs as $model)
			{
				if (!isset($model['span'])) {
					$result[] = [
							'label' => $model['name'],
							'url' => [
								'image/manager',
								'group_id' => $model['id'],
							]
					];		
				} else {
					$result[] = ['label' => $model['name']];				
				}
			}
		}
		
		return (!empty($result))? $result : null;
	}
	
}
