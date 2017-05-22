<?php

namespace app\modules\infosystems\models\backend;

use Yii;

/**
 * This is the model class for table "{{%infosystem_property}}".
 *
 * @property integer $id
 * @property string $infosystem_id
 * @property string $name
 * @property string $description
 * @property integer $required
 *
 * @property ItemProperty[] $infosystemItemProperties
 * @property Infosystem $infosystem
 */
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
