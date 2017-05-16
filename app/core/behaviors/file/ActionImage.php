<?php

namespace app\core\behaviors\file;


use yii\imagine\Image;
use Imagine\Image\Box;

/**
 * @todo
 * Class ActionImage
 * Класс не закончен, функции не используются
 * @package kigl\cef\core\behaviors\file
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */
class ActionImage extends ActionFile
{
    /*
	protected function resize($width, $height)
	{
		$this->_image->resize(new Box($width, $height));
		
		return $this->_image;
	}

	public function resizeWidth($width)
	{
	  $ratio = $width / $this->_image->getSize()->getWidth();
	  $height = $this->_image->getSize()->getHeight() * $ratio;
	  $this->resize($width,$height);

	  return $this->_image;
	}

	public function resizeHeight($height)
	{
	  $ratio = $height / $this->_image->getSize()->getHeight();
    $width = $this->_size->getSize()->getWidth() * $ratio;
    $this->resize($width,$height);

    return $this->_image;
	}
    */
}
