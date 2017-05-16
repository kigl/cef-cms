<?php
/**
 * Class ModelService
 * @package app\modules\infosystem\service
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystem\service;


use app\core\traits\Breadcrumbs;
use app\modules\infosystem\models\Group;

class ModelService extends \app\core\service\ModelService
{
    use Breadcrumbs;

    protected function getItemsBreadcrumb($modelInfosystem, $groupId = null, $itemName = null)
    {
        $breadcrumbs = [];

        if ($groupId) {
            $breadcrumbs = $this->buildBreadcrumbs([
                'items' => [
                    'id' => $groupId,
                    'selectField' => ['id', 'parent_id', 'name', 'infosystem_id', 'alias'],
                    'modelClass' => Group::className(),
                    'urlOptions' => [
                        'route' => '/infosystem/group/view',
                        'params' => ['id', 'alias', 'infosystem_id']
                    ],
                ],
            ]);
        }

        array_unshift(
            $breadcrumbs,
            ['label' => $modelInfosystem->name, 'url' => ['/infosystem/infosystem/view', 'id' => $modelInfosystem->id]]
        );

        if ($itemName) {
            $breadcrumbs[] = $itemName;
        }

        return $breadcrumbs;
    }
}