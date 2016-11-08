<?php

namespace app\modules\user\commands;

use Yii;

class RbacController extends \yii\console\Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $guest = $auth->createRole('guest');
        $register = $auth->createRole('register');
        $manager = $auth->createRole('manager');
        $admin = $auth->createRole('admin');

        $guest->description = 'Guest';
        $register->description = 'Register';
        $manager->description = 'Manager';
        $admin->description = 'Administrator';

        $auth->add($guest);
        $auth->add($register);
        $auth->addChild($register, $guest);
        $auth->add($manager);
        $auth->addChild($manager, $register);
        $auth->add($admin);
        $auth->addChild($admin, $manager);

        $auth->assign($admin, 1);
    }
}