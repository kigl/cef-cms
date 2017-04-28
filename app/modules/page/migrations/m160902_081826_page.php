<?php

use yii\db\Migration;

class m160902_081826_page extends Migration
{
	public $tableName = '{{%page}}';
	
    public function up()
    {
			$this->createTable($this->tableName, [
				'id' => $this->primaryKey(),
				'name' => $this->string(),
				'content' => $this->text(),
				'template' => $this->string(),
				'alias' => $this->string(),
				'meta_title' => $this->string(),
				'meta_description' => $this->string(),
			]);

        $this->execute("ALTER TABLE {$this->tableName} ADD `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `meta_description`;");
        $this->execute("ALTER TABLE {$this->tableName} ADD `update_time` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `create_time`;");
    }

    public function down()
    {
			$this->dropTable($this->tableName);
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
