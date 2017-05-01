<?php

namespace app\core\behaviors\file;


use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

class ActionFile extends Behavior
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
    public $name = null;
    /**
     * @var
     */
    protected $uploadedFileInstance = null;

    /**
     * @return array
     */
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate',
            ActiveRecord::EVENT_BEFORE_INSERT => 'beforeSave',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'beforeSave',
            ActiveRecord::EVENT_BEFORE_DELETE => 'deleteFile',
        ];
    }

    public function beforeValidate()
    {
        // Если из вне присваеваем аттрибуту экземпляр класса UploadedFile
        if ($this->getOwnerAttribute() instanceof UploadedFile) {
            $this->uploadedFileInstance = $this->getOwnerAttribute();
        }

        if ($instance = $this->getUploadedFileInstance()) {
            $this->setOwnerAttribute($instance);
        }
    }

    public function beforeSave()
    {
        if (Yii::$app->request->Post($this->getDeleteKey())) {
            $this->deleteFile();
            $this->setOwnerAttribute(null);
        }

        if ($this->uploadFile($this->getPath())) {
            if (!$this->owner->isNewRecord) {
                $this->deleteFile();
            }
        } elseif (!$this->owner->isNewRecord) {
            $this->setOwnerAttribute($this->getOldAttribute());
        }
    }

    protected function uploadFile($path)
    {
        $instance = $this->getUploadedFileInstance();
        if ($instance instanceof UploadedFile) {

            $path = $path . DIRECTORY_SEPARATOR . $this->getNameDir($this->getName());
            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }

            $nameExtension = $this->getName() . '.' . $instance->getExtension();
            $file = $path . DIRECTORY_SEPARATOR . $nameExtension;

            $this->setOwnerAttribute($nameExtension);

            return $instance->saveAs($file);
        }

        return false;
    }

    public function deleteFile()
    {
        $file = $this->getFilePath();
        if (is_file($file)) {
            @unlink($file);
        }
    }

    public function getPath()
    {
        return Yii::getAlias($this->path);
    }

    public function getPathUrl()
    {
        return Yii::getAlias($this->pathUrl);
    }

    public function getFileUrl()
    {
        $attribute = $this->getOldAttribute();

        return $this->getPathUrl() . '/' . $this->getNameDir($attribute) . '/' . $attribute;
    }

    public function getFilePath()
    {
        $attribute = $this->getOldAttribute();

        return $this->getPath() . DIRECTORY_SEPARATOR . $this->getNameDir($attribute) . DIRECTORY_SEPARATOR . $attribute;
    }

    protected function getOldAttribute()
    {
        return (isset($this->owner->oldAttributes[$this->attribute])) ? $this->owner->oldAttributes[$this->attribute] : '';
    }

    public function getOwnerAttribute()
    {
        return $this->owner->{$this->attribute};
    }

    protected function getName()
    {
        if (is_null($this->name)) {
            $instance = $this->owner->{$this->attribute};
            $this->name = md5(uniqid($instance));
        }

        return $this->name;
    }

    public function getUploadedFileInstance()
    {
        if (is_null($this->uploadedFileInstance)) {
            $this->uploadedFileInstance = UploadedFile::getInstance($this->owner, $this->attribute);
        }

        return $this->uploadedFileInstance;
    }

    protected function getNameDir($string = '', $length =1)
    {
        return substr($string, 0, $length);
    }

    public function fileExist()
    {
        return is_file($this->getFilePath());
    }

    protected function setOwnerAttribute($value)
    {
        $this->owner->{$this->attribute} = $value;
    }

    public function getDeleteKey()
    {
        return 'delete_' . $this->attribute;
    }
}
