<?php

namespace app\controllers;

use Yii;
use yii\widgets\Menu;

class SiteController extends \app\modules\main\components\controllers\FrontendController
{
    public function actionIndex()
    {
			return $this->render('index'); 
    }
    
    public function actionError()
    {
			return $this->render('error');
		}
		
		public function actionInit()
		{
			$model = \app\models\Menu::find()->asArray()->all();
			
    $levels = array();
    $tree = array();
    $cur = array();
   
    foreach ($model as $rows) {
       
       
        $cur = &$levels[$rows['id']];
        //$cur['loop'] = $rows['parent_id'];
        $cur['label'] = $rows['name'];
        $cur['url'] = ['site/init', 'id' => $rows['id']];
       
        if($rows['parent_id'] == 0){
            $tree[$rows['id']] = &$cur;
        }
        else{
            $levels[$rows['parent_id']]['items'][$rows['id']] = &$cur;
        }
       
    }
			
			echo Menu::widget([
				'items' => $tree,
				'activateParents' => true,
			]);
			
			echo Menu::widget([
				'items' => [
					['label' => 'test', 'url' => ['site/init']],
				],
			]);
			echo "<pre>";
			print_r($tree);
			//print_r($this->recursive(0, $result));
			echo "</pre>";
		}
		
		public function recursive($parent_id, $result)
		{
			if (isset($result[$parent_id])) {
			//	echo "<ul>";
				foreach ($result[$parent_id] as $value) {
					/*return [
						'label' => $value['name'],
						'url' => ['init', 'id' => $value['id']],
						'items' => [$this->recursive($value['id'], $result)]
					];*/
					//echo "<li>" . $value['name'];
					//$this->recursive($value['id'], $result);
					//echo "</li>";
					$menu;
				return [$menu];
				}
				//echo "</ul>";
			}
		}
		
}