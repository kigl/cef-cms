<?php
/**
 * User: ARstudio
 * Date: 26.12.2016
 * Time: 12:16
 */

namespace app\modules\shop\components\cart\actions;


use Yii;

class Add extends \yii\base\Action
{
    public $postNameProductId = 'productId';

    public $postNameCount = 'count';

    public function run()
    {
        $response = Yii::$app->response;
        $response->format = $response::FORMAT_JSON;

        if (Yii::$app->request->isPost) {
            $postData = Yii::$app->request->post();

            Yii::$app->cart->add($postData[$this->postNameProductId], $postData[$this->postNameCount]);

            return true;
        }

        return false;
    }
}