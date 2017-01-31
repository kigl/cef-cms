<?php
/**
 * Class InformationSystemViewService
 * @package app\modules\informationsystem\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\informationsystem\service\backend;


use app\core\service\ViewService;

class InformationSystemViewService extends ViewService
{
    public function getDataProvider()
    {
        return $this->getData('dataProvider');
    }
}