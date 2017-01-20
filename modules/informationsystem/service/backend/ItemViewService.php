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
}