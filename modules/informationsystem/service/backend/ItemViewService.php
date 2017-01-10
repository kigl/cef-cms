<?php
/**
 * Class ItemViewService
 * @package app\modules\informationsystem\service\backend
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\informationsystem\service\backend;

use Yii;
use app\core\service\ViewService;
use app\modules\informationsystem\models\Item;

class ItemViewService extends ViewService
{
    public function getModel()
    {
        return $this->getData('model');
    }

    public function getStatusList()
    {
        return [
            Item::STATUS_BLOCK => Yii::t('informationsystem', 'Status block'),
            Item::STATUS_ACTIVE => Yii::t('informationsystem', 'Status active'),
            Item::STATUS_DRAFT => Yii::t('informationsystem', 'Status draft'),
        ];
    }
}