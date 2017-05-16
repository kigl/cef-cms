<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 29.04.2017
 * Time: 6:58
 */

namespace app\modules\infosystem\service\backend;


use app\core\traits\Breadcrumbs;
use app\modules\infosystem\Module;

class ModelService extends \app\core\service\ModelService
{
    use Breadcrumbs;

    protected function getItemsBreadcrumb($infosystem, $groupId = null, $currentItemName = null)
    {
        $breadcrumbs = $this->buildBreadcrumbs([
            'items' => [
                'id' => $groupId,
                'selectField' => ['id', 'parent_id', 'name', 'infosystem_id', 'alias'],
                'modelClass' => \app\modules\infosystem\models\Group::className(),
                'urlOptions' => [
                    'route' => 'backend-group/manager',
                    'params' => ['id', 'infosystem_id'],
                ],
            ],
        ]);

        array_unshift(
            $breadcrumbs,
            ['label' => Module::t('Infosystems'), 'url' => ['backend-infosystem/manager']],
            ['label' => $infosystem->name, 'url' => ['backend-group/manager', 'infosystem_id' => $infosystem->id]]
        );

        if ($currentItemName) {
            $breadcrumbs[] = ['label' => $currentItemName];
        }

        return $breadcrumbs;
    }
}