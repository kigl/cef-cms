<?php
/**
 * Class Widget
 * @package app\modules\service\modules\form\widgets\frontend\form
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\form\widgets\form;


use Yii;
use yii\base\Model;
use app\modules\form\models\Form;
use app\modules\form\models\FieldValue;
use app\modules\form\models\Completed;
use app\modules\form\widgets\form\forms\FieldForm;

class Widget extends \yii\base\Widget
{
    const FLASH_FORM_COMPLETED = 'completed';

    public $formId;

    public $layout = 'default';

    public $fieldConfig = [];

    public $options = [];

    public $pjax = false;

    public $email;

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
        if (Model::loadMultiple($this->fieldsForm, \Yii::$app->request->post())
            && Model::validateMultiple($this->fieldsForm, ['value', 'verifyCode'])
        ) {
            // Сохраняеи
            $this->save();
            //Сообщение
            Yii::$app->session->setFlash(self::FLASH_FORM_COMPLETED, Yii::t('app', 'Message thank you'));

            if ($this->getForm()->send_email_curator) {
                $this->sendEmail();
            }

            // Обнуляем значения
            // Если не обнулить, то после сохранения, поля будут заполненны старыми данными
            $this->nullFieldsValue();
        }

        return $this->render('index', [
            'data' => [
                'model' => $this->getForm(),
                'fields' => $this->fieldsForm,
                'groupFields' => $this->getGroupFields(),
                'widget' => $this,
            ]
        ]);
    }

    /**
     * Инициализирует поля формы
     */
    protected function initFieldsForm()
    {
        $modelForm = $this->getForm();

        foreach ($modelForm->fields as $field) {
            $this->fieldsForm[$field->id] = new FieldForm([
                'required' => $field->required,
                'sorting' => $field->sorting,
            ]);
        }

        if ($modelForm->captcha) {
            $this->fieldsForm['captcha'] = new FieldForm(['captcha' => $modelForm->captcha]);
        }
    }

    protected function getForm()
    {
        $id = $this->formId;

        if (is_null($this->modelForm)) {
            $this->modelForm = Form::find()
                ->where(['id' => $id])
                ->with('fields.group')
                ->one();
        }

        return $this->modelForm;
    }

    protected function getGroupFields() {
        $result = [];

        foreach ($this->getForm()->fields as $key => $field) {
            if ($field->group) {
                $result[$field->group->sorting][$field->group->name][$field->sorting][$key] = $field;


            } else {
                $result[$field->sorting]['none'][$field->sorting][$key] = $field;
            }
        }

        ksort($result);

        return $result;
    }

    /**
     * Сохраяет полученные данные
     */
    protected function save()
    {
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
        }
    }

    protected function sendEmail()
    {
        $form = $this->getForm();

        $html = '';
        $html .= '<h1>' . $form->name . '</h1>';
        $html .= '<p>' . $form->description . '</p>';
        $html .= '<table width="100%" cellpadding="5px" style="border: 1px solid #444;"><tbody>';
        $html .= '<tr><th>Поле</th><th>Значение</th></tr>';

        foreach ($form->fields as $key => $field) {
            $html .= '<tr><td>' . $field->name . '</td><td>' . $this->fieldsForm[$key]->value . '</td></tr>';
        }

        $html .= '</tbody></table>';

        Yii::$app->mailer->compose()
            ->setFrom($form->email_from)
            ->setTo($form->email_curator)
            ->setSubject($form->name)
            ->setHtmlBody($html)
            ->send();
    }

    protected function nullFieldsValue()
    {
        foreach ($this->fieldsForm as $field) {
            $field->value = null;
        }
    }
}