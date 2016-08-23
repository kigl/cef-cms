<?php

namespace app\rbac;

class AuthorRule extends \yii\rbac\Rule
{
	public $name = 'isAuthor';
	
	public function execute($user, $item, $params)
	{
		return isset($params['model']) ? $params['model']->author_id == $user : false; 
	}
}

?>