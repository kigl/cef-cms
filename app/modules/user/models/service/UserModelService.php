<?php
/**
 * Created by PhpStorm.
 * User: ARstudio
 * Date: 08.11.2016
 * Time: 15:32
 */

namespace kigl\cef\module\user\models\service;

use Yii;
use yii\base\Model;
use kigl\cef\core\service\ModelService;
use kigl\cef\module\user\components\RbacService;
use kigl\cef\module\user\models\User;
use kigl\cef\module\user\models\Property;
use kigl\cef\module\user\models\PropertyRelation;
use kigl\cef\module\user\models\forms\PasswordRestoreForm;
use kigl\cef\module\user\models\forms\UserRegistrationForm;

class UserModelService extends ModelService
{
    protected $fields;

    protected $model;

    protected $rbacService;

    public function __construct(RbacService $rbacService, $config = [])
    {
        $this->rbacService = $rbacService;

        parent::__construct($config);
    }

    public function actionPersonal(array $params)
    {
        $this->model = User::find()
            ->where(['id' => $this->getData('id')])
            ->one();

        $this->initialization();

        if ($this->load($params) && $this->save()) {
            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'model' => $this->model,
            'fields' => $this->fields,
        ]);
    }

    public function actionRegistration($params)
    {
        $form = new UserRegistrationForm();

        if ($form->load($params) && $form->validate()) {
            $this->setExecutedAction(self::EXECUTED_ACTION_VALIDATE);
        }

        if ($this->hasExecutedAction(self::EXECUTED_ACTION_VALIDATE)) {
            $model = new User();
            $model->status = User::STATUS_ACTIVE;
            $model->attributes = $form->attributes;
            $model->save(false);

            $item = $this->rbacService->getItem(User::ROLE_REGISTRATION);
            $this->rbacService->assign($item, $model->id);
        }

        $this->setData([
            'model' => $form,
        ]);
    }

    public function actionPasswordRestore($params = [])
    {
        $form = new PasswordRestoreForm();

        if ($form->load($params) && $form->validate()) {
            $user = User::find()
                ->byEmail($form->email)
                ->one();

            $newPassword = Yii::$app->security->generateRandomString(8);
            echo $newPassword;
            $user->password = $newPassword;
            $user->save(false);
        }

        $this->setData([
            'model' => $form,
        ]);
    }

    protected function initialization()
    {
        $this->fields = $this->initFields();
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
            if ($success) $this->saveFields();

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
    public function initFields()
    {
        $fieldRelation = $this->model->getFields()->with('field')->indexBy('field_id')->all();
        $allField = Property::find()->indexBy('id')->all();

        foreach (array_diff_key($allField, $fieldRelation) as $field) {
            $fieldRelation[$field->id] = new PropertyRelation();
            $fieldRelation[$field->id]->field_id = $field->id;
        }

        return $fieldRelation;
    }

    public function saveFields()
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
