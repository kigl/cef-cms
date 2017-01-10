<?php
/**
 * Class UserModelService
 * @package app\modules\user\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\user\service\backend;


use yii\base\Model;
use app\core\service\ModelService;
use app\modules\user\models\User;
use app\modules\user\models\Field;
use app\modules\user\models\FieldRelation;

class UserModelService extends ModelService
{
    protected $model;

    protected $field;

    protected function init()
    {
        $this->field = $this->initField();
    }

    public function actionCreate(array $params)
    {
        $this->model = new User;
        $this->model->setScenario(User::SCENARIO_INSERT);

        $this->init();

        if ($this->load($params) && $this->save()) {
            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'model' => $this->model,
            'field' => $this->field,
        ]);
    }

    public function actionUpdate(array $params)
    {
        $this->model = User::find()
            ->byId($params['get']['id'])
            ->one();

        $this->model->setScenario(User::SCENARIO_UPDATE);

        $this->init();

        if ($this->load($params) && $this->save()) {
            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'model' => $this->model,
            'field' => $this->field,
        ]);
    }

    public function load(array $params)
    {
        $result = $this->model->load($params['post']);
        Model::loadMultiple($this->field, $params['post']);

        return $result;
    }

    public function save()
    {
        $transaction = User::getDb()->beginTransaction();

        $success = false;
        try {
            $success = $this->model->save();
            if ($success) {
                $this->saveField();
            }

            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();

            throw $e;
        }

        return $success;
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    protected function initField()
    {
        $fieldRelation = $this->model
            ->getFieldRelation()
            ->with('field')
            ->indexBy('field_id')
            ->all();

        $allField = Field::find()
            ->indexBy('id')
            ->all();

        foreach (array_diff_key($allField, $fieldRelation) as $field) {
            $fieldRelation[$field->id] = new FieldRelation();
            $fieldRelation[$field->id]->field_id = $field->id;
        }

        return $fieldRelation;
    }

    public function saveField()
    {
        foreach ($this->field as $field) {
            $field->user_id = $this->model->id;

            if (!empty($field->value)) {
                $field->save();
            } else {
                //$field->delete();
            }
        }
    }
}