<?php

use yii\db\Migration;

class m170206_120351_form extends Migration
{
    protected $_tableName = '{{%form}}';

    public function up()
    {
        $this->createTable($this->_tableName, [
            'id' => $this->primaryKey(),
            'site_id' => $this->integer(),
            'name' => $this->string(),
            'description' => $this->string(),
            'captcha' => $this->integer(),
            'email_from' => $this->string(),
            'email_curator' => $this->string(),
            'send_email_curator' => $this->integer(),
        ]);

        $this->execute("ALTER TABLE {$this->_tableName} ADD `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `send_email_curator`;");

        $this->createIndex('ix-form-site_id', $this->_tableName, 'site_id');

    }

    public function down()
    {
        $this->dropTable($this->_tableName);
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
