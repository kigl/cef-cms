<?php

namespace kigl\cef\core\behaviors\file;

use Yii;
use yii\db\ActiveRecord;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadFile extends \yii\base\Behavior
{
	/**
	* @var 
	*/	
	public $attribute;
	/**
	* @var 
	*/		
	public $path;
	/**
	* @var 
	*/		
	public $pathUrl;
	/**
	* @var 
	*/		
	public $name;

	/**
	* alias @app/temp
	* @var 
	*/		
	public $tempDir = 'temp';
	/**
	* @var 
	*/	
	protected $tempFile;
	
	
	/**
	* события
	* @return mixed
	*/
	public function events()
	{
		return [
			ActiveRecord::EVENT_BEFORE_VALIDATE => 'setInstanceAttribute',
			ActiveRecord::EVENT_BEFORE_INSERT => 'beforeSave',
			ActiveRecord::EVENT_BEFORE_UPDATE => 'beforeSave',
			ActiveRecord::EVENT_BEFORE_DELETE => 'deleteFile',
		];
	}

    public function beforeSave()
	{
		$instance = $this->owner->{$this->attribute};
		// если загружаем файл
		if ($instance instanceof UploadedFile) {
			if (is_dir($this->getPath())) {
				// присваеваем файл
				$this->name = $this->getNameExtensionFile();
				$pathFile = $this->getPath() . DIRECTORY_SEPARATOR . $this->name;
				// сохраняем
				if ($instance->saveAs($pathFile)) {
					// если не новая запись
					if (!$this->owner->isNewRecord) {
						// удаляем старый файл
						$this->deleteFile();
					}
					// присваеваем аттрибуту имя файла 			
					$this->setDbAttribute($this->name);
				}
			}
		} elseif (!$this->owner->isNewRecord) { // если не заргужаем файл, то остовляем аттрибут без изменения
			$this->owner->{$this->attribute} = $this->getOldAttribute();
 		}	
 		// если $deleteKey активный, то удвляем файл
 		if (Yii::$app->request->Post($this->getDeleteKey())) {
			$this->deleteFile();
			$this->setDbAttribute(null);
		}
	} 
	
	/**
	* Удаляет файл
	*/
	public function deleteFile()
	{
		$pathFile = $this->getPath() . DIRECTORY_SEPARATOR . $this->getOldAttribute();

		if (is_file($pathFile)) {
			@unlink($pathFile);
		}
	}
		
	protected function saveTempFile()
	{
		$instance = $this->owner->{$this->attribute};
		
		if ($instance instanceof UploadedFile) {
			$this->tempFile = $this->getNameExtensionFile();
			$this->owner->{$this->attribute}->saveAs($this->getTempPath() . DIRECTORY_SEPARATOR . $this->tempFile);
		}
	}
	
	protected function deleteTempFile()
	{
		if (is_file($this->getTempFilePath())) {
			@unlink($this->getTempFilePath());
		}
	}
	
	protected function getTempFilePath()
	{
		return $this->getTempPath() . DIRECTORY_SEPARATOR . $this->tempFile;
	}
	
		/**
	* Присваевает аттрибуту экземпляр UploadededFile
	*/
	public function setInstanceAttribute()
	{	 
		if ($instance = $this->getFileInstance()) {
			$this->owner->{$this->attribute} = $instance;
		}
	}	
	
	/**
	* Присваевает значение для записи в базуданных
	* @param undefined $name
	* 
	* @return
	*/
	protected function setDbAttribute($name)
	{
		$this->owner->{$this->attribute} = $name;
	}
	
	/**
	* @return экземпляр UploadedFile
	*/
	protected function getFileInstance()
	{
		$instance = UploadedFile::getInstance($this->owner, $this->attribute);
		if ($instance) {
			return $instance;
		}
		return false;		
	}
	
	protected function getOldFilePath()
	{
		return $this->getPath() . DIRECTORY_SEPARATOR . $this->getOldAttribute();
	}
	
	protected function getOldAttribute()
	{
		return $this->owner->oldAttributes[$this->attribute];
	}
	
	/**
	* @return путь
	*/
	public function getPath()
	{
		return $this->path;
	}
	
	/**
	* @return имя с расширением
 	*/
	public function getNameExtensionFile()
	{
		$nameExtension = $this->getName() . '.' . $this->owner->{$this->attribute}->getExtension();
		
		return $nameExtension;
	}
	
	/**
	* @return имя
	*/
	protected function getName()
	{
		$instance = $this->owner->{$this->attribute};
		$name = md5(uniqid($instance));
		
		return $name;
	}
	
	protected function getTempPath()
	{
		$path = Yii::getAlias("@app/{$this->tempDir}");
		if (!is_dir($path)) {
			mkdir($path);
		}
		
		return $path;
	}
	
	public  function getFileUrl()
	{
		return $this->pathUrl . '/' . $this->getOldAttribute();
	}
	
	public function fileExist()
	{
		if ((!$this->owner->isNewRecord) and is_file($this->getOldFilePath())) {
			return true;
		}
		return false;
	}

	public function getDeleteKey()
    {
        return 'remove_' . $this->attribute;
    }
}
