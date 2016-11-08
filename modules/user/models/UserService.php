<?php
/**
 * Created by PhpStorm.
 * User: ARstudio
 * Date: 08.11.2016
 * Time: 15:32
 */

namespace app\modules\user\models;

use yii\base\Model;
use app\core\service\ModelServiceInterface;

class UserService implements ModelServiceInterface
{
    private $model;
    private $field;

    public function __construct(User $model)
    {
        $this->model = $model;

        $this->init();
    }

    private function init()
    {
        $this->field = $this->initField();
    }

    public function load(array $post)
    {
        $result = $this->model->load($post);
        Model::loadMultiple($this->field, $post);

        return $result;
    }

    public function validate()
    {
        return false;
    }

    public function save()
    {
        $transaction = User::getDb()->beginTransaction();

        try {
            $this->model->save();
            $this->saveField();

            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();

            throw $e;
        }
    }

    public function delete()
    {
        return false;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getData()
    {
        return [
            'model' => $this->model,
            'field' => $this->field,
        ];
    }

    public function setModelScenario($scenario)
    {
        $this->model->scenario = $scenario;
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public function initField()
    {
        $fieldRelation = $this->model->getFieldRelation()->with('field')->indexBy('field_id')->all();
        $allField = Field::find()->indexBy('id')->all();

        foreach (array_diff_key($allField, $fieldRelation) as $field) {
            $fieldRelation[$field->id] = new FieldRelation();
            $fieldRelation[$field->id]->field_id = $field->id;
        }

        return $fieldRelation;
    }

    /**
     * @param $fields
     */
    public function saveField()
    {
        foreach ($this->field as $field) {
            $field->user_id = $this->model->id;

            if (!empty($field->value)) {
                $field->save();
            } else {
                $field->delete();
            }
        }
    }

}