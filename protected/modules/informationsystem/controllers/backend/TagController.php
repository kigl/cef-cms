<?php

namespace app\modules\informationsystem\controllers\backend;

use sjaakp\taggable\TagSuggestAction;
use app\modules\informationsystem\models\Tag;

class TagController extends \app\modules\main\components\controllers\BackendController  
{

  public function actions() 
  {
    return [
      'suggest' => [
          'class' => TagSuggestAction::className(),
          'tagClass' => Tag::className(),
      ],
    ];
  }
  
  public function actionTest()
  {
		var_dump(Tag::find()->where(['id' => 1])->all()->items);
	}
}