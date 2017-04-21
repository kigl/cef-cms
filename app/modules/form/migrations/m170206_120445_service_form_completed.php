<?php

use yii\db\Migration;

class m170206_120445_service_form_completed extends Migration
{
    protected $tableName = '{{%form_completed}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'form_id' => $this->integer(),
            'user_id' => $this->integer(),
        ]);

        $this->execute("ALTER TABLE {$this->tableName} ADD `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `user_id`;");

        $this->createIndex('ix-form_completed-user_id', $this->tableName, 'user_id');
        $this->createIndex('ix-form_completed-form_id', $this->tableName, 'form_id');
        $this->addForeignKey('fk-form_completed-form_id', $this->tableName, 'form_id', '{{%form}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-form_completed-user_id', $this->tableName, 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
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
