<?php
/**
 * Class GroupViewService
 * @package app\modules\informationsystem\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\informationsystem\service\backend;


use app\core\service\ViewService;

class GroupViewService extends ViewService
{

    public function getSearchModel()
    {
        return $this->getData('searchModel');
    }

    public function getDataProvider()
    {
        return $this->getData('dataProvider');
    }

    public function getGroupDataProvider()
    {
        return $this->getData('groupDataProvider');
    }

    public function getModel()
    {
        return $this->getData('model');
    }

    public function getInformationSystemId()
    {
        return $this->getData('informationSystemId');
    }

    public function getParentId()
    {
        return $this->getData('parentId');
    }

    public function getId()
    {
        return $this->getData('id');
    }
}