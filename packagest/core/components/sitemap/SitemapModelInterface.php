<?php
/**
 * Class SitemapModelInterface
 * @package app\modules\sitemap\components
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace kigl\cef\core\components\sitemap;


interface SitemapModelInterface
{
    public function getModelItems();

    public function getModelItemUrl();
}