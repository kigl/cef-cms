<?php

namespace kigl\cef\core\behaviors\file;


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
        if ($instance = $this->getUploadedFileInstance()) {
            $this->setOwnerAttribute($instance);
        }
    }

    public function beforeSave()
    {
        if ($this->uploadFile($this->getPath())) {
            if (!$this->owner->isNewRecord) {
                $this->deleteFile();
            }
        } elseif (!$this->owner->isNewRecord) {
            $this->setOwnerAttribute($this->getOldAttribute());
        }

        /**
         * @todo
         */
        if (Yii::$app->request->Post($this->getDeleteKey())) {
            $this->deleteFile();
            $this->setOwnerAttribute(null);
        }
    }

    protected function uploadFile($path)
    {
        $instance = $this->getOwnerAttribute();
        if ($instance instanceof UploadedFile) {
            if (!is_dir($path)) {
                mkdir($path);
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
        $pathFile = $this->getPath() . DIRECTORY_SEPARATOR . $this->getOldAttribute();

        if (is_file($pathFile)) {
            @unlink($pathFile);
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
        return $this->getPathUrl() . '/' . $this->getOldAttribute();
    }

    protected function getFilePath()
    {
        return $this->getPath() . DIRECTORY_SEPARATOR . $this->getOldAttribute();
    }

    protected function getOldAttribute()
    {
        return $this->owner->oldAttributes[$this->attribute];
    }

    protected function getOwnerAttribute()
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

    protected function getUploadedFileInstance()
    {
        if (is_null($this->uploadedFileInstance)) {
            $this->uploadedFileInstance = UploadedFile::getInstance($this->owner, $this->attribute);
        }

        return $this->uploadedFileInstance;
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
