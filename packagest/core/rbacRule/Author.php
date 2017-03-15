<?php
/**
 * Class Author
 * @package app\core\rbacRule
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace kigl\cef\core\rbacRule;


use yii\rbac\Rule;

class Author extends Rule
{
    public $name = 'isAuthor';

    public function execute($user, $item, $params)
    {
        return isset($params) ? $params == $user : false;
    }
}