<?php

namespace app\components\behaviors;

use yii\base\Model;

class TranslitInUrl extends \yii\base\Behavior
{
	public $text;

	public $url;

	public function events()
	{
		return [
			Model::EVENT_BEFORE_VALIDATE => 'run',
		];
	}

	public function run()
	{
		if ($this->owner->{$this->url} == '') {
			$this->owner->{$this->url} = $this->translit($this->owner->{$this->text});
		}
	}

	private function translit($s) 
	{
	  $s = (string) $s; // преобразуем в строковое значение
	  $s = strip_tags($s); // убираем HTML-теги
	  $s = str_replace(array("\n", "\r"), " ", $s); // убираем перевод каретки
	  $s = preg_replace("/\s+/", ' ', $s); // удаляем повторяющие пробелы
	  $s = trim($s); // убираем пробелы в начале и конце строки
	  $s = mb_strtolower($s, "utf-8"); // переводим строку в нижний регистр (иногда надо задать локаль)
	  $s = strtr($s, array('а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'e','ж'=>'j','з'=>'z','и'=>'i','й'=>'y','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h','ц'=>'c','ч'=>'ch','ш'=>'sh','щ'=>'shch','ы'=>'y','э'=>'e','ю'=>'yu','я'=>'ya','ъ'=>'','ь'=>''));
	  $s = preg_replace("/[^0-9a-z-_ ]/i", "", $s); // очищаем строку от недопустимых символов
	  $s = str_replace(" ", "-", $s); // заменяем пробелы знаком минус

		return $s; 
	} 
}
