<?php
/**
 * Class CartService
 * @package app\core\service
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\core\service;


class CartService implements CartServiceInteface
{
    public function add($id, $count)
    {
        echo $id;
    }

    public function delete($id)
    {

    }

    public function deleteAll()
    {

    }
}