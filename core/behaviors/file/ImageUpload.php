<?php

namespace app\core\behaviors\file;

use Yii;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Gd\Imagine;
use Imagine\Image\Box;

class ImageUpload extends \app\core\behaviors\file\FileUpload
{
	public $thumbnailPrefix = 'thumbnail_';
	
	public $thumbnail;
	
	private $_image;
	
	public function beforeSave()
	{
		$instance = $this->owner->{$this->attribute};
		// если загружаем файл
		if ($instance instanceof UploadedFile) {
			// сохраняем файл
			$this->saveFile();
			if (!$this->owner->isNewRecord) {
				// удаляем старый файл
				$this->deleteFile();
				$this->deleteThumbnail();
			}
			// присваеваем имя файла для записи в DB
			$this->setDbAttribute($this->tempFile);
		} elseif (!$this->owner->isNewRecord) { // если не загружаем файл
			// присваеваем имя файла для записи в DB
			$this->setDbAttribute($this->getOldAttribute());
		}
		// если $deleteKey активный, то удвляем файл
		if (Yii::$app->request->Post($this->deleteKey)) {
			$this->deleteFile();
			$this->deleteThumbnail();
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
		$this->_image = (new Imagine)->open($this->getTempFilePath());
			
		// создает миниатюру
		if (is_array($this->thumbnail)) {
			$this->createThumbnail();
		}
	
		$this->_image->save($this->getPath() . DIRECTORY_SEPARATOR . $this->tempFile);
		// удаляем темп файл
		$this->deleteTempFile();
	}

	public function deleteFile()
    {
        parent::deleteFile();

        $this->deleteThumbnail();
    }
	
	protected function createThumbnail()
	{
		Image::thumbnail($this->getTempFilePath(), $this->thumbnail['width'], $this->thumbnail['height'])
			->save($this->getPath() . DIRECTORY_SEPARATOR . $this->thumbnailPrefix . $this->tempFile);
	}
	
	
	public function getThumbnailName()
	{
		return $this->thumbnailPrefix . $this->getOldAttribute();
	}
	
	public function getThumbnailUrl()
	{
		return $this->pathUrl . '/' . $this->getThumbnailName();
	}
	
	public function getThumbnailFilePath()
	{
		return $this->path . DIRECTORY_SEPARATOR . $this->getThumbnailName();
	}
	
	public function thumbnailExist()
	{
		if (is_file($this->getThumbnailFilePath())) {
			return true;
		}
		
		return false;
	}
	
	public function deleteThumbnail()
	{
		$fileName = $this->thumbnailPrefix . $this->getOldAttribute();
		@unlink($this->getPath() . DIRECTORY_SEPARATOR . $fileName);
	}
	
	protected function resize($width, $height)
	{
		$this->_image->resize(new Box($width, $height));
		
		return $this->_image;
	}
	
	/**
	 * Изменяет размер по ширине
	 * @param  [interface] $width
	 */
	public function resizeWidth($width)
	{
	  $ratio = $width / $this->_image->getSize()->getWidth();
	  $height = $this->_image->getSize()->getHeight() * $ratio;
	  $this->resize($width,$height);

	  return $this->_image;
	}

	/**
	 * Изменяет размер по высоте
	 * @param  [interface] $height [description]
	 */
	public function resizeHeight($height)
	{
	  $ratio = $height / $this->_image->getSize()->getHeight();
    $width = $this->_size->getSize()->getWidth() * $ratio;
    $this->resize($width,$height);

    return $this->_image;
	}
}
