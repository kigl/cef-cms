<?php
/**
 * Class Service
 * @package app\modules\form\models\backend\service
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\form\models\backend\service;


use app\core\service\ModelService;
use app\core\traits\Breadcrumbs;
use app\modules\form\models\backend\Group;

class Service extends ModelService
{
    use Breadcrumbs;

    protected function getItemsBreadcrumb($form, $groupId = null)
    {

        $breadcrumbs = $this->buildBreadcrumbs([
            'items' => [
                'id' => $groupId,
                'modelClass' => Group::class,
                'urlOptions' => [
                    'route' => 'backend-group/manager',
                    'params' => ['form_id', 'id'],
                ],
            ],
        ]);

        array_unshift($breadcrumbs, ['label' => $form->name, 'url' => ['backend-group/manager', 'form_id' => $form->id]]);

        return $breadcrumbs;
    }
}