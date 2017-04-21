<?php

use yii\db\Migration;

class m170206_120352_form_group extends Migration
{
    protected $tableName = '{{%form_group}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(),
            'form_id' => $this->integer(),
            'name' => $this->string(),
            'description' => $this->string(),
            'sorting' => $this->integer()->defaultValue(500),
        ]);

        $this->execute("ALTER TABLE {$this->tableName} ADD `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `sorting`;");
        $this->execute("ALTER TABLE {$this->tableName} ADD `update_time` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `create_time`;");

        $this->createIndex('ix-form_group_form_id', $this->tableName, 'form_id');
        $this->createIndex('ix-form_group_parent_id', $this->tableName, 'parent_id');

        $this->addForeignKey('fk-form_group-parent_id', $this->tableName, 'parent_id', $this->tableName, 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-form_group-form_id', $this->tableName, 'form_id', '{{%form}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable($this->tableName);

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
