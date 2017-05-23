<?php
/**
 * Class Rule
 * @package app\modules\infosystem\components\urlRules
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystems\components\urlRules;


use Yii;

abstract class Rule
{
    protected $routeAction = '';

    protected $urlItemName = '';

    protected function buildUrl($url = '', $params)
    {
        if ($query = http_build_query($params)) {
            $url .= '?' . $query;
        }

        return $url;
    }
}