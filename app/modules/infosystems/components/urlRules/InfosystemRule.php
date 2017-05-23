<?php
/**
 * Class UrlInfosystemRule
 * @package app\modules\infosystem\components
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystems\components\urlRules;


class InfosystemRule extends Rule
{
    protected $urlItemName = 'infosystem';

    protected $routeAction = 'infosystems/infosystem/view';

    public function getUrl($route, $params)
    {
        if ($route !== $this->routeAction) {
            return false;
        }

        $url = '';

        $url .= $params['id'];

        unset($params['id']);

        return $this->buildUrl($url, $params);
    }

    public function parseRequest($routeItem)
    {
        if (empty($routeItem[1]) && empty($routeItem[2])) {

            return [$this->routeAction, ['id' => $routeItem[0]]];
        }

        return false;
    }
}