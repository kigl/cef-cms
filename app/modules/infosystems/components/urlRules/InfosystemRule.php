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

    public function getUrl($route, $params, $infosystems = [])
    {
        if ($route !== $this->routeAction) {
            return false;
        }

        $url = '';

        $url .= $infosystems[$params['id']];

        unset($params['id']);

        return $this->buildUrl($url, $params);
    }

    public function parseRequest($routeItem, $infosystems = [])
    {
        if (empty($routeItem[1]) && empty($routeItem[2])) {

            return [$this->routeAction, ['id' => array_search($routeItem[0], $infosystems)]];
        }

        return false;
    }
}