<?php
/**
 * Class Action
 * @package app\modules\property\actions
 * @author Kirill Golodaev <kirillgolodaev@gmail.com>
 */


namespace app\modules\property\actions;


abstract class Action extends \yii\base\Action
{
    public $modelClass;

    public $infosystem_id = null;

    public $view;

    public $redirect;

    public $queryId = 'id';
}