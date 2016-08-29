<?php

namespace app\modules\main\components\behaviors;

use Yii;
use yii\db\ActiveRecord;
use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use yii\web\UploadedFile;

class imageUpload extends \app\modules\main\components\behaviors\FileUpload
{
	public $resize = [];
	
	public function beforeSave()
	{
		$instance = $this->owner->{$this->attribute};
		// если загружаем файл
		if ($instance instanceof UploadedFile) {
			// сохраняем файл
			$this->saveFile();
			if (!$this->owner->isNewRecord) {
				// удаляем старый файл
				$this->deleteOldFile();
			}
			// присваеваем имя файла для записи в DB
			$this->setDbAttribute($this->tempFile);
		} elseif (!$this->owner->isNewRecord) { // если не загружаем файл
			// присваеваем имя файла для записи в DB
			$this->setDbAttribute($this->getOldAttribute());
		}
		// если $deleteKey активный, то удвляем файл
		if (Yii::$app->request->Post($this->deleteKey)) {
			$this->deleteOldFile();
			$this->setDbAttribute(null);
		}
	}
	
	/**
	* Сохраняет файл
	* 
	* @return
	*/
	public function saveFile()
	{
		$this->saveTempFile();
		// работаем с файлом
		$image = (new Imagine)->open($this->getTempFilePath())
    		->resize(new Box($this->resize['width'], $this->resize['height'])) // меняем размер
				->save($this->getPath() . DS . $this->tempFile);		
		// удаляем темп файл
		$this->deleteTempFile();
	}
	
	public function imageExist()
	{
		return $this->fileExist();
	}
}
