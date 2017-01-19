<?php
/**
 * Created by PhpStorm.
 * User: ARstudio
 * Date: 08.11.2016
 * Time: 15:32
 */

namespace app\modules\user\service\frontend;

use app\modules\user\models\forms\PasswordRestoreForm;
use app\modules\user\models\forms\UserRegistrationForm;
use Yii;
use yii\base\Model;
use app\core\service\ModelService;
use app\modules\user\models\User;
use app\modules\user\models\Field;
use app\modules\user\models\FieldRelation;

class UserModelService extends ModelService
{
    protected $field;

    public function actionPersonal(array $params)
    {
        $this->model = User::find()
            ->byId($params['id'])
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

    public function actionRegistration($params)
    {
        $form = new UserRegistrationForm();

        if ($form->load($params) && $form->validate()) {
            $this->setExecutedAction(self::EXECUTED_ACTION_VALIDATE);
        }

        if ($this->hasExecutedAction(self::EXECUTED_ACTION_VALIDATE)) {
            $model = new User();
            $model->attributes = $form->attributes;
            $model->save(false);
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

    protected function init()
    {
        $this->field = $this->initField();
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
            if ($success) $this->saveField();

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
