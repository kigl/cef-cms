<?php
/**
 * Class Template
 * @package app\modules\site\models\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\sites\models\backend;


class Template extends \app\modules\sites\models\Template
{
    public function getLayoutsList()
    {
        $path = \Yii::$app->view->theme->getLayoutsPath();

        $files = scandir($path);

        $result = [];
        foreach ($files as $file) {
            if (is_file($path . DIRECTORY_SEPARATOR . $file) &&
                substr($file, -4, 4) == '.php') {

                $result[] = strstr($file, '.', true);
            }
        }

        return array_combine($result, $result);
    }
}
