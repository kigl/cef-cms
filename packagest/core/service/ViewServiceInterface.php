<?php
/**
 * User: ARstudio
 * Date: 08.12.2016
 * Time: 14:01
 */

namespace kigl\cef\core\service;


interface ViewServiceInterface
{
    public function setData(array $data);

    public function getData($data = null);
}