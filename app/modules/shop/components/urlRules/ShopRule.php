<?php
/**
 * Class UrlInfosystemRule
 * @package app\modules\infosystem\components
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\shop\components\urlRules;


class ShopRule extends Rule
{
    protected $urlItemName = 'shop';

    protected $routeAction = 'shop/shop/view';

    public function getUrl($route, $params, $shops = [])
    {
        if ($route !== $this->routeAction) {
            return false;
        }

        $url = '';

        $url .= $shops[$params['id']];

        unset($params['id']);

        return $this->buildUrl($url, $params);
    }

    public function parseRequest($routeItem, $shops = [])
    {
        if (empty($routeItem[1]) && empty($routeItem[2])) {

            return [$this->routeAction, ['id' => array_search($routeItem[0], $shops)]];
        }

        return false;
    }
}