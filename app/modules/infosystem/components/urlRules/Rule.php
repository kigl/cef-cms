<?php
/**
 * Class Rule
 * @package app\modules\infosystem\components\urlRules
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystem\components\urlRules;


use Yii;

abstract class Rule
{
    protected $routeAction = '';

    protected $urlItemName = '';

    protected function builUrl($url = '', $params)
    {
        if ($query = http_build_query($params)) {
            $url .= '?' . $query;
        }

        return $url;
    }
}