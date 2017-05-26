<?php

namespace app\modules\infosystems\models\backend;


class Property extends \app\modules\infosystems\models\Property
{
    public function behaviors()
    {
        return [
            'sorting' => [
                'class' => \kotchuprik\sortable\behaviors\Sortable::className(),
                'query' => self::find(),
                'orderAttribute' => 'sorting',
            ],
        ];
    }
}
