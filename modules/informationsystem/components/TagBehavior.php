<?php

namespace app\modules\informationsystem\components;

use Yii;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;
use app\modules\informationsystem\models\Tag;
use app\modules\informationsystem\models\TagRelations;

class TagBehavior extends \yii\base\Behavior
{
    protected $_tags;

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'afterSave',
            ActiveRecord::EVENT_AFTER_UPDATE => 'afterSave',
        ];
    }

    public function afterSave()
    {
        /**
         * старые теги элемента
         * @var array
         */
        $oldTags = ArrayHelper::index($this->getTags(), 'name');
        /**
         * полученные теги элемента
         * @var array
         */
        $newTags = empty($this->_tags) ? [] : explode(',', $this->_tags);
        $newTagsModel = []; // новый список тегов

        foreach ($newTags as $newTag) {
            if (isset($oldTags[$newTag])) { // если в старых тегах есть полученные теги
                $newTagsModel[$newTag] = $oldTags[$newTag];
            } else {
                $nt = Tag::findOne(['name' => $newTag]); // поиск тегов
                if (!$nt) { // если тег не найден, то создаем его
                    $nt = new Tag;
                    $nt->setAttributes(['name' => $newTag, 'informationsystem_id' => $this->owner->informationsystem_id]);
                    $nt->save();
                }

                $newTagsModel[$newTag] = $nt;
            }
        }

        /**
         * Маасив для удаления
         * @var array
         */
        $removeTag = ArrayHelper::getColumn(array_diff_key($oldTags, $newTagsModel), 'id');
        /**
         * Маасив для создание связей
         * @var array
         */
        $addTag = ArrayHelper::getColumn(array_diff_key($newTagsModel, $oldTags), 'id');

        if (count($removeTag)) {
            /**
             * Удаляем связи
             */
            Yii::$app->db->createCommand()->delete(TagRelations::tableName(), ['tag_id' => $removeTag])
                ->execute();
        }

        if (count($addTag)) {
            foreach ($addTag as $nt) {
                $result[] = [$this->owner->id, $nt];
            }
            /**
             * Добавляем связи
             */
            Yii::$app->db->createCommand()->batchInsert(TagRelations::tableName(), ['item_id', 'tag_id'], $result)
                ->execute();
        }
    }

    public function getTags()
    {
        return Tag::find()
            ->alias('m')
            ->leftJoin(TagRelations::tableName() . ' r', 'm.id = r.tag_id')
            ->where('r.item_id = :id', [':id' => $this->owner->id])
            ->asArray()
            ->all();
    }

    public function setEditorTag($tags)
    {
        $this->_tags = $tags;
    }

    public function getEditorTag()
    {
        return implode(',', ArrayHelper::getColumn($this->getTags(), 'name'));
    }
}

?>