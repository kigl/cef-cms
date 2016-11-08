<?php
namespace app\modules\informationsystem\widgets\backend\fileInForm;

class Widget extends \yii\base\Widget
{
    public $model;

    public $attribute;

    public $deleteKey;

    public $behaviorName;

    public function run()
    {
        return $this->render('index', [
            'model' => $this->model,
            'attribute' => $this->attribute,
            'deleteKey' => $this->deleteKey,
            'behaviorName' => $this->behaviorName,
        ]);
    }
}

?>