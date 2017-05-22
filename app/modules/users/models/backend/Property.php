<?php

namespace app\modules\users\models\backend;


/**
 * This is the model class for table "{{%user_field}}".
 *
 * @property integer $id
 * @property string $name
 *
 * @property UserFieldRelation[] $userFieldRelations
 * @property User[] $users
 */
class Property extends \app\modules\users\models\Property
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
