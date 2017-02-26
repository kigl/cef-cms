<?php
/**
 * Class ItemModelService
 * @package app\modules\infosystem\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystem\service\backend;

use app\modules\infosystem\models\Item;
use app\core\service\ModelService;
use app\modules\infosystem\models\ItemProperty;
use app\modules\infosystem\models\Property;
use yii\base\Model;

class ItemModelService extends ModelService
{
    protected $itemProperties;

    protected $properties;

    protected $model;

    public function actionCreate()
    {
        $this->model = new Item([
            'infosystem_id' => $this->getData('get', 'infosystem_id'),
            'group_id' => $this->getData('get', 'group_id'),
        ]);

        $this->initProperties();

        if ($this->save()) {
            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'model' => $this->model,
            'itemProperties' => $this->itemProperties,
            'properties' => $this->properties,
        ]);
    }

    public function actionUpdate()
    {
        $this->model = Item::find()
            ->byId($this->getData('get', 'id'))
            ->one();

        $this->initProperties();

        if ($this->save()) {
            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'model' => $this->model,
            'itemProperties' => $this->itemProperties,
            'properties' => $this->properties,
        ]);
    }

    public function actionDelete($id)
    {
        $this->model = Item::findOne($id);

        if ($this->model->delete()) {
            $this->setExecutedAction(self::EXECUTED_ACTION_DELETE);
        }

        $this->setData([
            'model' => $this->model,
        ]);
    }

    protected function load()
    {
        $post = $this->getData('post');

        if ($this->model->load($post) && Model::loadMultiple($this->itemProperties, $post)) {
            return true;
        }

        return false;
    }

    protected function validate($validate = true)
    {
        if ($validate) {
            if ($this->model->validate($validate) && $this->validateItemProperties($validate)) {
                return true;
            } else {
                return false;
            }
        }

        return true;
    }

    protected function save($validate = true)
    {
        if ($this->load() && $this->validate($validate)) {
            $this->model->save();
            $this->saveItemProperties();

            return true;
        }

        return false;
    }

    protected function validateItemProperties($validate = true)
    {
        if ($validate) {
            $success = true;

            foreach ($this->itemProperties as $key => $property) {
                if ($property->requiredValue && $property->value == '') {
                    $property->validate();

                    $success = false;
                }
            }

            return $success;
        }

        return true;
    }

    protected function saveItemProperties()
    {
        foreach ($this->itemProperties as $property) {
            if ($property->value != '') {
                $property->item_id = $this->model->id;
                $property->save();
            } else {
                $property->delete();
            }
        }
    }

    protected function initProperties()
    {
        $this->itemProperties = $this->model->getProperties()
            ->indexBy('property_id')
            ->all();

        $this->properties = Property::find()
            ->where(['infosystem_id' => $this->model->infosystem_id])
            ->indexBy('id')
            ->all();

        foreach (array_diff_key($this->properties, $this->itemProperties) as $property) {
            $this->itemProperties[$property->id] = new ItemProperty([
                'property_id' => $property->id,
            ]);
        }

        // присваеваем виртуальному полю значение
        foreach ($this->properties as $property) {
            $this->itemProperties[$property->id]->requiredValue = $property->required;
        }
    }
}