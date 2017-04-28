<?php
/**
 * Class ItemModelService
 * @package app\modules\infosystem\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystem\models\backend\service;


use yii\base\Model;
use yii\helpers\ArrayHelper;
use app\modules\infosystem\Module;
use app\core\service\ModelService;
use app\core\traits\Breadcrumbs;
use app\modules\infosystem\models\backend\Item;
use app\modules\infosystem\models\backend\ItemProperty;
use app\modules\infosystem\models\backend\Property;
use app\modules\infosystem\models\backend\Infosystem;

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

        if (!$infosystem) {
            throw new HttpException(500);
        }

        $this->initProperties();

        $this->setData([
            'model' => $this->model,
            'itemProperties' => $this->itemProperties,
            'properties' => $this->properties,
            'breadcrumbs' => $this->getBreadcrumbs($infosystem, $this->model->group_id),
        ]);

        return $this->save();
    }

    public function actionUpdate()
    {
        $this->model = Item::find()
            ->byId($this->getData('get', 'id'))
            ->with(['infosystem'])
            ->one();

        if (!$this->model) {
            throw new HttpException(500);
        }

        $this->initProperties();

        $this->setData([
            'model' => $this->model,
            'itemProperties' => $this->itemProperties,
            'properties' => $this->properties,
            'breadcrumbs' => $this->getBreadcrumbs($this->model->infosystem, $this->model->group_id,
                $this->model->name),
        ]);

        return $this->save();
    }

    public function actionDelete($id)
    {
        $this->model = Item::findOne($id);

        if (!$this->model) {
            return false;
        }

        $this->setData([
            'model' => $this->model,
        ]);

        return $this->model->delete();
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

    protected function save($validate = true)
    {
        if ($this->load() && $this->validate($validate)) {
            $this->saveTags();
            $this->model->save();
            $this->saveItemProperties();

            return true;
        }

        return false;
    }

    protected function saveTags()
    {
        $tagsOnSave = $this->model->getRuntimeTags();

        $oldTags = ArrayHelper::getColumn($this->model->tags, 'name');

        $newTags = array_diff($tagsOnSave, $oldTags);

        $removeTags = array_diff($oldTags, $tagsOnSave);


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

    protected function getBreadcrumbs($infosystem, $groupId, $currentItemName = null)
    {
        $breadcrumbs = $this->buildBreadcrumbs([
            'items' => [
                'id' => $groupId,
                'modelClass' => \app\modules\infosystem\models\Group::className(),
                'urlOptions' => [
                    'route' => 'backend-group/manager',
                    'params' => ['id', 'infosystem_id'],
                ],
            ],
        ]);

        array_unshift(
            $breadcrumbs,
            ['label' => Module::t('Infosystems'), 'url' => ['backend-infosystem/manager']],
            ['label' => $infosystem->name, 'url' => ['backend-group/manager', 'infosystem_id' => $infosystem->id]]
        );

        if ($currentItemName) {
            array_push($breadcrumbs, ['label' => $currentItemName]);
        }

        return $breadcrumbs;
    }
}