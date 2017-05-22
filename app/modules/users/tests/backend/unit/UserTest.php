<?php
/**
 * Class UserTest
 * @package kigl\cef\module\user\tests\backend\unit
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace kigl\cef\module\user\tests\backend\unit;


use kigl\cef\module\user\models\base\User;

class UserTest extends \PHPUnit_Framework_TestCase
{
    public function testUserEmptyValues()
    {
        $user = new User();

        $this->assertFalse($user->validate(), 'sadsad');
    }
}