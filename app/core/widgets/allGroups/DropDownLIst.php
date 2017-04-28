<?php
/**
 * Class DropDownLIst
 * @package app\core\widgtes\allGroups
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\core\widgets\allGroups;


use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class DropDownLIst extends BaseAllGroup
{
    public function run()
    {
        $items = $this->getAllItems();
        $result = [];

        $this->generateListItems($items, $result);

        Html::addCssClass($this->options, 'form-control');

        echo Html::activeDropDownList(
            $this->model,
            $this->attribute,
            ArrayHelper::map($result, 'id', 'name'),
            ArrayHelper::merge([
                'encode' => false,
                'prompt' => [
                    'text' => Yii::t('app','Root'),
                    'value' => null,
                    'options' => [],
                ]
            ],
                $this->options
            )
        );
    }

    protected function generateListItems(&$data, &$result, $parentId = null, $level = 1)
    {
        foreach ($data as $item) {
            if ($item['parent_id'] == $parentId) {

                array_push(
                    $result,
                    ['id' => $item['id'], 'name' => str_repeat('&nbsp;', $level * 3) . $item['name']]
                );

                $this->generateListItems($data, $result, $item['id'], $level + 1);
            }
        }
    }
}