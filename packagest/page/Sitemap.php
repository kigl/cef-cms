<?php
/**
 * Class Sitemap
 * @package app\modules\page
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\page;


use app\modules\page\models\Page;
use app\modules\sitemap\components\SitemapModule;

class Sitemap extends SitemapModule
{
    public function getModels()
    {
        return [
            [
                'class' => Page::class,
                'changefreq' => self::WEEKLY,
                'priority' => 0.2,
            ],
        ];
    }
}