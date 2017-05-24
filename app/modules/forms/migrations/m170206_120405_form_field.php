<?php

use yii\db\Migration;

class m170206_120405_form_field extends Migration
{
    protected $tableName = '{{%form_field}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'group_id' => $this->integer(),
            'form_id' => $this->integer(),
            'name' => $this->string(),
            'description' => $this->string(),
            'type' => $this->integer(),
            'list_id' => $this->integer(),
            'required' => $this->integer()->defaultValue(0),
            'sorting' => $this->integer()->defaultValue(500),
        ]);

        $this->createIndex('ix-form_field-form_id', $this->tableName, 'form_id');
        $this->createIndex('ix-form_field-group_id', $this->tableName, 'group_id');

        $this->addForeignKey('fk-form_field-form_id', $this->tableName, 'form_id', '{{%form}}', 'id', 'CASCADE', 'CASCADE');

        $this->addForeignKey('fk-form_field-group_id', $this->tableName, 'group_id', '{{%form_group}}', 'id', 'CASCADE', 'CASCADE');
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
