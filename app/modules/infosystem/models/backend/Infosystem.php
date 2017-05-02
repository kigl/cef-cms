<?php

namespace app\modules\infosystem\models\backend;


use Yii;
use yii\helpers\ArrayHelper;

class Infosystem extends \app\modules\infosystem\models\Infosystem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            ['indexing', 'default', 'value' => self::INDEXING_YES],
            [['template', 'template_group', 'template_item'], 'default', 'value' => 'view'],
            [['group_on_page', 'item_on_page'], 'default', 'value' => '30'],
            [['sorting_type_group', 'sorting_type_item'], 'default', 'value' => SORT_ASC],
            [['sorting_field_group', 'sorting_field_item'], 'default', 'value' => 'id'],
            [
                'sorting_field_group',
                'validateExistFieldInList',
                'params' => ['listFields' => 'sortingListFieldGroup']
            ],
            [
                'sorting_field_item',
                'validateExistFieldInList',
                'params' => ['listFields' => 'sortingListFieldItem']
            ],
            [['sortingListFieldGroup', 'sortingListFieldItem'], 'safe'],
        ]);
    }

    public function validateExistFieldInList($attribute, $params)
    {
        if (!array_key_exists($this->{$attribute}, array_flip($this->{$params['listFields']}))) {
            $this->addError(
                $attribute,
                Yii::t('infosystem', 'Does not exist ({field}) in the list of fields',
                    ['field' => $this->{$attribute}])
            );
        }
    }

    public function isChangeId()
    {
        return $this->getDirtyAttributes(['id']);
    }

    public function getSortingTyps()
    {
        return [
            SORT_ASC => Yii::t('app', 'ASC'),
            SORT_DESC => Yii::t('app', 'DESC'),
        ];
    }

    public function setSortingListFieldGroup($value)
    {
        $this->sorting_list_field_group = json_encode($value);
    }

    public function setSortingListFieldItem($value)
    {
        $this->sorting_list_field_item = json_encode((array)$value);
    }
}
