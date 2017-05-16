<?php
/**
 * Class Service
 * @package app\modules\form\models\backend\service
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\form\models\backend\service;


use app\core\traits\Breadcrumbs;
use app\modules\form\models\backend\Group;
use app\modules\form\Module;

class ModelService extends \app\core\service\ModelService
{
    use Breadcrumbs;

    protected function getItemsBreadcrumb($form = null, $groupId = null, $currentName = null)
    {
        $breadcrumbs = [];

        if ($groupId) {
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
        }

        if ($form) {
            array_unshift($breadcrumbs,
                ['label' => $form->name, 'url' => ['backend-group/manager', 'form_id' => $form->id]]);
        }

        array_unshift($breadcrumbs, ['label' => Module::t('Forms'), 'url' => ['backend-form/manager']]);

        if ($currentName) {
            $breadcrumbs[] = ['label' => $currentName];
        }

        return $breadcrumbs;
    }
}