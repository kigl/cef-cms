<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 17.12.2016
 * Time: 21:40
 */

namespace app\modules\shop\widgets\frontend\searchProduct;

use Yii;

class Widget extends \yii\base\Widget
{
    public function run()
    {
        $dataRequestSearch = Yii::$app->request->getQueryParam('value');

        return $this->render('index', ['value' => $dataRequestSearch]);
    }
}