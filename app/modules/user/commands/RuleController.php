<?php
/**
 * Class RuleController
 * @package kigl\cef\module\user\commands
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\user\commands;


use Yii;
use yii\console\Controller;
use app\core\rbacRule\Author;

class RuleController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        $rule = new Author();
        $auth->add($rule);
    }
}