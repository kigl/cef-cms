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
				'alias' => $this->string(),
				'meta_title' => $this->string(),
				'meta_description' => $this->string(),
				'create_time' => $this->integer(),
				'update_time' => $this->integer(),
			]);
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
