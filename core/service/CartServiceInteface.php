<?php
/**
 * User: ARstudio
 * Date: 23.12.2016
 * Time: 14:22
 */

namespace app\core\service;


interface CartServiceInteface
{
    public function add($id, $count);

    public function delete($id);

    public function deleteAll();
}