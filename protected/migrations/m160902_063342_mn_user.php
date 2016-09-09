<?php

use yii\db\Migration;

class m160902_063342_mn_user extends Migration
{
	public $tableName = 'mn_user';
	
    public function up()
    {
			$this->createTable($this->tableName, [
				'id' => $this->primaryKey(),
				'role' => $this->integer(),
				'login' => $this->string(50),
				'surname' => $this->string(100),
				'name' => $this->string(100),
				'lastname' => $this->string(100),
				'email' => $this->string(50),
				'password' => $this->string(),
				'auth_key' => $this->string(300),
				'status' => $this->integer(),
				'create_time' => $this->integer(),
				'update_time' => $this->integer(),
				'ip' => $this->string(50),
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
