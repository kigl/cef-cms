<?php
/**
 * Class ModelService
 * @package app\modules\infosystem\service
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\infosystems\service;


use app\core\traits\Breadcrumbs;
use app\modules\infosystems\models\Group;

class ModelService extends \app\core\service\ModelService
{
    use Breadcrumbs;

    protected function getItemsBreadcrumb($infosystemModel, $groupId = null, $itemName = null)
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
                        'params' => ['id', 'alias', 'infosystem_code']
                    ],
                ],
            ]);
        }

        array_unshift(
            $breadcrumbs,
            ['label' => $infosystemModel->name, 'url' => ['/infosystem/infosystem/view', 'id' => $infosystemModel->id]]
        );

        if ($itemName) {
            $breadcrumbs[] = $itemName;
        }

        return $breadcrumbs;
    }
}