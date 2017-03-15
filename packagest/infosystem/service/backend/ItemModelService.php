<?php
/**
 * Class ItemModelService
 * @package app\modules\infosystem\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystem\service\backend;


use yii\base\Model;
use app\core\traits\Breadcrumbs;
use app\modules\infosystem\models\Item;
use app\core\service\ModelService;
use app\modules\infosystem\models\ItemProperty;
use app\modules\infosystem\models\Property;
use app\modules\infosystem\models\Infosystem;
use app\modules\infosystem\models\Group;

class ItemModelService extends ModelService
{
    use Breadcrumbs;

    protected $itemProperties;

    protected $properties;

    protected $model;

    public function actionCreate()
    {
        $this->model = new Item([
            'infosystem_id' => $this->getData('get', 'infosystem_id'),
            'group_id' => $this->getData('get', 'group_id'),
        ]);
        $infosystem = Infosystem::findOne($this->model->infosystem_id);

        $this->initProperties();

        if ($this->save()) {
            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'model' => $this->model,
            'itemProperties' => $this->itemProperties,
            'properties' => $this->properties,
            'breadcrumbs' => $this->getBreadcrumbs($infosystem, $this->model->group_id),
        ]);
    }

    public function actionUpdate()
    {
        $this->model = Item::find()
            ->byId($this->getData('get', 'id'))
            ->with('infosystem')
            ->one();

        $this->initProperties();

        if ($this->save()) {
            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'model' => $this->model,
            'itemProperties' => $this->itemProperties,
            'properties' => $this->properties,
            'breadcrumbs' => $this->getBreadcrumbs($this->model->infosystem, $this->model->group_id),
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

        if ($this->itemProperties) {
            Model::loadMultiple($this->itemProperties, $post);
        }

        if ($this->model->load($post)) {
            return true;
        }

        return false;
    }

    protected function validate($validate = true)
    {
        if ($validate) {
            if ($this->model->validate($validate) && $this->validateProperties($validate)) {
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

    protected function validateProperties($validate = true)
    {
        $success = true;

        if ($validate) {

            foreach ($this->itemProperties as $key => $property) {
                if (!$property->validate()) {

                    $success = false;
                }
            }
        }

        return $success;
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

        $this->sortingProperties($this->itemProperties, $this->properties);
    }

    /**
     * Сортирует свойства
     */
    protected function sortingProperties(&$properties, $allProperties)
    {
        $tmp = [];
        foreach ($allProperties as $p) {
            $tmp[$p->id] = $p->sorting;
        }

        asort($tmp);

        $tmp2 = [];
        foreach ($tmp as $key => $value) {
            $tmp2[$key] = $properties[$key];
        }

        $properties = $tmp2;
    }

    protected function getBreadcrumbs(Infosystem $infosystem, $group_id)
    {
        $breadcrumbs = $this->buildBreadcrumbs([
            'group' => [
                'id' => $group_id,
                'modelClass' => Group::class,
                'urlOptions' => [
                    'route' => '/backend/infosystem/group/manager',
                    'params' => ['id', 'infosystem_id'],
                ],
            ],
        ]);

        array_unshift($breadcrumbs, ['label' => $infosystem->name, 'url' => ['group/manager', 'infosystem_id' => $infosystem->id]]);

        return $breadcrumbs;
    }
}