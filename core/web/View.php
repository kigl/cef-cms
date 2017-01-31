<?php
/**
 * Class View
 * @package app\core\web
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */

namespace app\core\web;


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
        return $this->title;
    }

    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    public function getMetaKeywords()
    {
        return $this->metaKeywords;
    }

    public function getPageHeader()
    {
        return $this->pageHeader;
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