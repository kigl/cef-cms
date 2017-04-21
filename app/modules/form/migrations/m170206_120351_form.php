<?php

use yii\db\Migration;

class m170206_120351_form extends Migration
{
    public $tableName = '{{%form}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'description' => $this->string(),
            'captcha' => $this->integer(),
            'email_from' => $this->string(),
            'email_curator' => $this->string(),
            'send_email_curator' => $this->integer(),
        ]);

        $this->execute("ALTER TABLE {$this->tableName} ADD `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `send_email_curator`;");

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
