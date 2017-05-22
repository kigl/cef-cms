<?php
/**
 * Class UserModelService
 * @package app\modules\user\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\users\service\backend;


use yii\base\Model;
use app\core\service\ModelService;
use app\modules\users\components\RbacService;
use app\modules\users\models\backend\User;
use app\modules\users\models\backend\Property;
use app\modules\users\models\backend\PropertyRelation;

class UserModelService extends ModelService
{
    protected $model;

    protected $properties;

    protected $userProperties;

    protected $rbacService;

    public function __construct(RbacService $rbacService, $config = [])
    {
        $this->rbacService = $rbacService;

        parent::__construct($config);
    }

    public function create()
    {
        $this->model = new User;

        $this->initProperties();

        $this->setData([
            'model' => $this->model,
            'properties' => $this->properties,
            'userProperties' => $this->userProperties,
        ]);

        return $this->save();
    }

    public function update()
    {
        $this->model = User::find()
            ->byId($this->getData('get', 'id'))
            ->one();

        $this->model->rolePermission = array_keys($this->rbacService->manager->getAssignments($this->model->id));

        $this->initProperties();

        $this->setData([
            'model' => $this->model,
            'properties' => $this->properties,
            'userProperties' => $this->userProperties,
        ]);

        return $this->save();
    }

    public function view($id)
    {
        $model = User::findOne($id);

        $this->setData([
            'model' => $model,
        ]);
    }

    protected function load()
    {
        $post = $this->getData('post');

        if ($this->userProperties) {
            Model::loadMultiple($this->userProperties, $post);
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

            foreach ($this->userProperties as $key => $property) {
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
        foreach ($this->userProperties as $property) {
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
        $this->userProperties = $this->model
            ->getProperties()
            ->indexBy('property_id')
            ->all();

        $this->properties = Property::find()
            ->indexBy('id')
            ->all();

        foreach (array_diff_key($this->properties, $this->userProperties) as $property) {
            $this->userProperties[$property->id] = new PropertyRelation([
                'property_id' => $property->id,
            ]);
        }

        // присваеваем значения виртуальным полям (не сохраняются)
        foreach ($this->properties as $property) {
            $this->userProperties[$property->id]->requiredValue = $property->required;
        }

        $this->sortingProperties($this->userProperties, $this->properties);
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
