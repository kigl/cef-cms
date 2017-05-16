<?php

namespace app\modules\infosystem;


use Yii;
/**
 * infosystem module definition class
 */
class Module extends \app\core\module\Module
{
    const VERSION = '1.0.0.01';
    const MAX_WIDTH_HEIGHT_IMAGE = 1024;
    const DEFAULT_SORTING = 500;
    const DEFAULT_ITEM_ON_PAGE = 30;
    const DEFAULT_TEMPLATE_NAME = 'view';
    const DEFAULT_SORTING_FIELD = 'id';

}
