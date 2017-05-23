<?php
/**
 * Class ItemModelService
 * @package app\modules\infosystem\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystems\service\backend;


use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\web\HttpException;
use app\modules\infosystems\models\backend\Item;
use app\modules\infosystems\models\backend\ItemProperty;
use app\modules\infosystems\models\backend\Property;
use app\modules\infosystems\models\backend\Infosystem;
use app\modules\infosystems\models\backend\Tag;
use app\modules\infosystems\models\ItemTag;

class ItemModelService extends ModelService
{
    protected $itemProperties;

    protected $properties;

    protected $model;

    public function create()
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
            'tags' => Tag::find()->asArray()->all(),
            'itemProperties' => $this->itemProperties,
            'properties' => $this->properties,
            'breadcrumbs' => $this->getItemsBreadcrumb($infosystem, $this->model->group_id),
        ]);

        return $this->save();
    }

    public function update()
    {
        $this->model = Item::find()
            ->where(['id' => $this->getData('get', 'id')])
            ->with(['infosystem'])
            ->one();

        if (!$this->model) {
            throw new HttpException(500);
        }

        $this->initProperties();

        $this->setData([
            'model' => $this->model,
            'itemProperties' => $this->itemProperties,
            'tags' => Tag::find()->asArray()->all(),
            'properties' => $this->properties,
            'breadcrumbs' => $this->getItemsBreadcrumb($this->model->infosystem, $this->model->group_id,
                $this->model->name),
        ]);

        return $this->save();
    }

    public function delete($id)
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
        $this->itemProperties = $this->model->getItemProperties()
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
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $this->model->save();
                $this->saveTags();
                $this->saveItemProperties();

                $transaction->commit();
            } catch (\Exception $e) {
                $transaction->rollBack();

                throw $e;
            }

            return true;
        }

        return false;
    }

    protected function saveTags()
    {
        $tagsOnSave = $this->model->getRuntimeTags();

        $itemTags = ArrayHelper::getColumn($this->model->tags, 'id');

        if ($newItemTags = array_diff($tagsOnSave, $itemTags)) {

            $itemTag = [];
            foreach ($newItemTags as $id) {

                $itemTag[] = [$this->model->id, $id];
            }

            Yii::$app->db->createCommand()
                ->batchInsert(ItemTag::tableName(), ['item_id', 'tag_id'], $itemTag)
                ->execute();
        }


        if ($removeTags = array_diff($itemTags, $tagsOnSave)) {
            Yii::$app->db->createCommand()->delete(ItemTag::tableName(), ['tag_id' => $removeTags])
                ->execute();
        }
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
}