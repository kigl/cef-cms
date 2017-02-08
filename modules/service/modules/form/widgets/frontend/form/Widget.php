<?php
/**
 * Class Widget
 * @package app\modules\service\modules\form\widgets\frontend\form
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\service\modules\form\widgets\frontend\form;


use yii\base\Model;
use app\modules\service\modules\form\models\Form;
use app\modules\service\modules\form\models\FieldValue;
use app\modules\service\modules\form\models\Completed;
use app\modules\service\modules\form\widgets\frontend\form\forms\FieldForm;

class Widget extends \yii\base\Widget
{
    /**
     * Id формы
     * @var
     */
    public $formId;

    protected $modelForm = null;

    protected $fieldsForm = [];

    public function init()
    {
        // Инициализируем поля формы (каждое поле объект формы FieldForm)
        $this->initFieldsForm();

        parent::init();
    }

    public function run()
    {
        if (Model::loadMultiple($this->fieldsForm,
                \Yii::$app->request->post()) && Model::validateMultiple($this->fieldsForm,
                ['value'])
        ) {
            // Сохраняеи
            $this->save();
        }

        return $this->render('index', [
            'data' => [
                'model' => $this->getForm(),
                'fields' => $this->fieldsForm,
            ]
        ]);
    }

    protected function getForm()
    {
        $id = $this->formId;

        if (is_null($this->modelForm)) {
            $this->modelForm = Form::find()
                ->where(['id' => $id])
                ->with('fields')
                ->one();
        }

        return $this->modelForm;
    }

    /**
     * Инициализирует поля формы
     */
    protected function initFieldsForm()
    {
        foreach ($this->getForm()->fields as $field) {
            $this->fieldsForm[$field->id] = new FieldForm(['required' => $field->required]);
        }
    }

    /**
     * Сохраяет полученные данные
     */
    protected function save() {
        $model = $this->getForm();

        // Создаем объект заполненной формы
        $completed = new Completed(['form_id' => $model->id]);
        $completed->save();

        // Сохраняем поля
        foreach ($model->fields as $key => $field) {
            $fieldValue = new FieldValue([
                'form_completed_id' => $completed->id,
                'field_id' => $field->id,
                'value' => $this->fieldsForm[$key]->value,
            ]);
            $fieldValue->save(false);

            // Обнуляем значения
            // Если не обнулить, то после сохранения, поля будут заполненны старыми данными
            $this->fieldsForm[$key]->value = null;
        }
    }
}