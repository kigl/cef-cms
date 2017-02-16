<?php
/**
 * Class UserModelService
 * @package app\modules\user\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\user\service\backend;


use yii\base\Model;
use yii\helpers\ArrayHelper;
use app\core\service\ModelService;
use app\modules\user\components\RbacService;
use app\modules\user\models\User;
use app\modules\user\models\Field;
use app\modules\user\models\FieldRelation;

class UserModelService extends ModelService
{
    protected $model;

    protected $fields;

    protected $rbacService;

    public function __construct()
    {
        $this->rbacService = new RbacService();
    }

    protected function init()
    {
        $this->fields = $this->initFields();
    }

    public function actionCreate(array $params)
    {
        $this->model = new User;

        $this->init();

        if ($this->load($params) && $this->save()) {
            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'model' => $this->model,
            'fields' => $this->fields,
            'roleListItem' => ArrayHelper::map(
                $this->rbacService->getItems(),
                'name', 'name', 'type'
            )
        ]);
    }

    public function actionUpdate(array $params)
    {
        $this->model = User::find()
            ->byId($params['get']['id'])
            ->one();

        $this->model->rolePermission = array_keys($this->rbacService->manager->getAssignments($this->model->id));

        $this->init();

        if ($this->load($params) && $this->save()) {
            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'model' => $this->model,
            'fields' => $this->fields,
            'roleListItem' => ArrayHelper::map(
                $this->rbacService->getItems(),
                'name', 'name', 'type'
            )
        ]);
    }

    public function actionView($id)
    {
        $model = User::findOne($id);

        $this->setData([
            'model' => $model,
        ]);
    }

    public function load(array $params)
    {
        $result = $this->model->load($params['post']);
        Model::loadMultiple($this->fields, $params['post']);

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
                $this->rbacService->saveUserAssignment($this->model->rolePermission, $this->model->id);
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
    protected function initFields()
    {
        $fieldRelation = $this->model
            ->getFields()
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
        foreach ($this->fields as $field) {
            $field->user_id = $this->model->id;

            if (!empty($field->value)) {
                $field->save();
            } else {
                $field->delete();
            }
        }
    }
}