<?php

use yii\db\Migration;

class m170519_041900_site extends Migration
{
    protected $_tableName = '{{%site}}';

    public function up()
    {
        $this->createTable($this->_tableName, [
            'id' => $this->primaryKey(),
            'domain' => $this->string(),
            'name' => $this->string(),
            'description' => $this->text(),
            'robots_txt' => $this->text(),
            'template_id' => $this->string(),
            'layout' => $this->string(),
        ]);
    }

    public function down()
    {
        $this->dropTable($this->_tableName);
    }
}
