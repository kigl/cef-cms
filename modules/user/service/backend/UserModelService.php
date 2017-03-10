<?php
/**
 * Class UserModelService
 * @package app\modules\user\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\user\service\backend;


use yii\base\Model;
use app\core\service\ModelService;
use app\modules\user\components\RbacService;
use app\modules\user\models\User;
use app\modules\user\models\Property;
use app\modules\user\models\PropertyRelation;

class UserModelService extends ModelService
{
    protected $model;

    protected $properties;

    protected $rbacService;

    public function __construct(RbacService $rbacService, $config = [])
    {
        $this->rbacService = $rbacService;

        parent::__construct($config);
    }

    public function actionCreate()
    {
        $this->model = new User;

        $this->initProperties();

        if ($this->save()) {
            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'model' => $this->model,
            'properties' => $this->properties,
        ]);
    }

    public function actionUpdate()
    {
        $this->model = User::find()
            ->byId($this->getData('get', 'id'))
            ->one();

        $this->model->rolePermission = array_keys($this->rbacService->manager->getAssignments($this->model->id));

        $this->initProperties();

        if ($this->save()) {
            $this->setExecutedAction(self::EXECUTED_ACTION_SAVE);
        }

        $this->setData([
            'model' => $this->model,
            'properties' => $this->properties,
        ]);
    }

    public function actionView($id)
    {
        $model = User::findOne($id);

        $this->setData([
            'model' => $model,
        ]);
    }

    public function load()
    {
        $post = $this->getData('post');

        if ($this->properties) {
            Model::loadMultiple($this->properties, $post);
        }

        return $this->model->load($post);
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

    /**
     * Валидация свойств
     * @param bool $validate
     * @return bool
     */
    protected function validateProperties($validate = true)
    {
        if ($validate) {
            $success = true;

            foreach ($this->properties as $key => $property) {
                if ($property->requiredValue && $property->value == '') {
                    $property->validate();

                    $success = false;
                }
            }

            return $success;
        }

        return true;
    }

    public function save($validate = true)
    {
        $success = false;

        if ($this->load() && $this->validate($validate)) {
            if ($success = $this->model->save($validate)) {
                $this->saveProperties($validate = true);
                $this->rbacService->saveUserAssignment($this->model->rolePermission, $this->model->id);
            }

            return $success;
        }

        return $success;
    }

    /**
     * Сохранят свойства
     */
    public function saveProperties($validate = true)
    {
        foreach ($this->properties as $property) {
            $property->user_id = $this->model->id;

            if (!empty($property->value)) {
                $property->save($validate = true);
            } else {
                $property->delete();
            }
        }
    }


    /**
     * Инициализирует свойства
     */
    protected function initProperties()
    {
        $this->properties = $this->model
            ->getProperties()
            ->indexBy('property_id')
            ->all();

        $allProperties = Property::find()
            ->indexBy('id')
            ->all();

        foreach (array_diff_key($allProperties, $this->properties) as $property) {
            $this->properties[$property->id] = new PropertyRelation([
                'property_id' => $property->id,
            ]);
        }

        // присваеваем значения виртуальным полям (не сохраняются)
        foreach ($allProperties as $property) {
            $this->properties[$property->id]->name = $property->name;
            $this->properties[$property->id]->requiredValue = $property->required;
        }

        $this->sortingProperties($this->properties, $allProperties);
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
