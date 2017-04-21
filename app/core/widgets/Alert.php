<?php

namespace app\core\widgets;


use Yii;
use yii\base\Widget;

class Alert extends Widget
{
    const TYPE_INFO = 'alert-info';
    const TYPE_DANGER = 'alert-danger';
    const TYPE_SUCCESS = 'alert-success';
    const TYPE_WARNING = 'alert-warning';
    const TYPE_PRIMARY = 'bg-primary';
    const TYPE_DEFAULT = 'well';
    const TYPE_CUSTOM = 'alert-custom';

    public function run()
    {
        $session = Yii::$app->session;
        $flashes = $session->getAllFlashes();

        foreach ($flashes as $type => $message) {

            echo \yii\bootstrap\Alert::widget([
                'options' => ['class' => $type],
                'body' => $message,
            ]);

            $session->removeFlash($type);
        }
    }
}