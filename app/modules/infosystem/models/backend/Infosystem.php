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
            [['template', 'template_group', 'template_item'], 'default', 'value' => 'view'],
            [['group_on_page', 'item_on_page'], 'default', 'value' => '30'],
            [['sorting_type_group', 'sorting_type_item'], 'default', 'value' => SORT_ASC],
            [['sorting_attribute_group', 'sorting_attribute_item'], 'default', 'value' => 'id'],
            [
                'sorting_attribute_group',
                'validateExistAttributeInList',
                'params' => ['listAttribute' => 'sortingListAttributeGroup']
            ],
            [
                'sorting_attribute_item',
                'validateExistAttributeInList',
                'params' => ['listAttribute' => 'sortingListAttributeItem']
            ],
            [['sortingListAttributeGroup', 'sortingListAttributeItem'], 'safe'],
        ]);
    }

    public function validateExistAttributeInList($attribute, $params)
    {
        if (!array_key_exists($this->{$attribute}, array_flip($this->{$params['listAttribute']}))) {
            $this->addError(
                $attribute,
                Yii::t('infosystem', 'Does not exist ({attribute}) in the list of attributes',
                    ['attribute' => $this->{$attribute}])
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

    public function setSortingListAttributeGroup($value)
    {
        $this->sorting_list_attribute_group = json_encode($value);
    }

    public function setSortingListAttributeItem($value)
    {
        $this->sorting_list_attribute_item = json_encode((array)$value);
    }
}
