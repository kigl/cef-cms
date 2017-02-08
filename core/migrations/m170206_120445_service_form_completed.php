<?php

use yii\db\Migration;

class m170206_120445_service_form_completed extends Migration
{
    protected $tableName = '{{%service_form_completed}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'form_id' => $this->integer(),
            'user_id' => $this->integer(),
        ]);

        $this->execute("ALTER TABLE {$this->tableName} ADD `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `user_id`;");

        $this->createIndex('ix-service_form_completed-user_id', $this->tableName, 'user_id');
        $this->createIndex('ix-service_form_completed-form_id', $this->tableName, 'form_id');
        $this->addForeignKey('fk-service_form_completed-form_id', $this->tableName, 'form_id', '{{%service_form}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-service_form_completed-user_id', $this->tableName, 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        echo "m170206_120445_service_form_completed cannot be reverted.\n";

        return false;
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
