<?php
/**
 * Class Site
 * @package app\modules\site\models\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\site\models\backend;


use yii\helpers\ArrayHelper;

class Site extends \app\modules\site\models\Site
{
    public function getTemplateList()
    {
        $model = Template::find()
            ->select(['id'])
            ->all();

        return ArrayHelper::map($model, 'id', 'id');
    }
}