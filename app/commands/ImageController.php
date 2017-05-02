<?php
/**
 * Class ImageController
 * @package app\commands
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\commands;


use Yii;
use app\modules\infosystem\models\Item;
use yii\console\Controller;

class ImageController extends Controller
{
    public function actionIndex()
    {
        /*
        $path = Yii::getAlias('@webroot/public/uploads/infosystem');

        $models = Item::findOne(445);

        $files = scandir($path);

        unset($files[0], $files[1]);

        foreach ($files as $file) {
            $pathFile = $path . DIRECTORY_SEPARATOR . $file;
            if (is_file($pathFile)) {

                $newPath = $path . DIRECTORY_SEPARATOR . substr($file, 0, 1);

                if (!is_dir($newPath)) {
                    mkdir($newPath, 0777, true);
                }

                $newPathFile = $newPath . DIRECTORY_SEPARATOR . $file;

                copy($pathFile, $newPathFile);
            }
        }
        */

        //print_r(scandir($path));
    }
}