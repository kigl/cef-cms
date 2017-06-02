<?php

use yii\db\Migration;

class m170519_041900_site extends Migration
{
    protected $_tableName = '{{%site}}';

    public function up()
    {
        $this->createTable($this->_tableName, [
            'id' => $this->primaryKey(),
            'domain' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'robots_txt' => $this->text(),
            'upload_dir' => $this->string()->notNull(),
            'template_id' => $this->string()->notNull(),
            'layout' => $this->string()->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable($this->_tableName);
    }
}
