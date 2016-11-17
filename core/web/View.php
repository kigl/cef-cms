<?php
/**
 * Class View
 * @package app\core\web
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */

namespace app\core\web;

use yii\helpers\Html;

class View extends \yii\web\View
{
    private $metaDescription;
    private $metaKeywords;
    private $pageHeader;
    private $breadcrumbs = [];
    private $module;

    public function setTitle($data)
    {
        $this->title = $data;
    }

    public function setMetaDescription($data)
    {
        $this->metaDescription = $data;
    }

    public function setMetaKeywords($data)
    {
        $this->metaKeywords = $data;
    }

    public function setPageHeader($data)
    {
        $this->pageHeader = $data;
    }

    public function setBreadcrumbs($data)
    {
        $this->breadcrumbs = $data;
    }

    public function getTitle()
    {
        return Html::encode($this->title);
    }

    public function getMetaDescription()
    {
        return Html::encode($this->metaDescription);
    }

    public function getMetaKeywords()
    {
        return Html::encode($this->metaKeywords);
    }

    public function getPageHeader()
    {
        return Html::encode($this->pageHeader);
    }

    public function getBreadcrumbs()
    {
        return $this->breadcrumbs;
    }

    public function getModule()
    {
        return $this->context->module;
    }
}