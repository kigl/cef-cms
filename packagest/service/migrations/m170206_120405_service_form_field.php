<?php

use yii\db\Migration;

class m170206_120405_service_form_field extends Migration
{
    protected $tableName = '{{%service_form_field}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'form_id' => $this->integer(),
            'name' => $this->string(),
            'description' => $this->string(),
            'type' => $this->integer(),
            'required' => $this->integer()->defaultValue(0),
            'sorting' => $this->integer(),
        ]);

        $this->createIndex('ix-service_form_field-form_id', $this->tableName, 'form_id');

        $this->addForeignKey('fk-service_form_field-form_id', $this->tableName, 'form_id', '{{%service_form}}', 'id', 'CASCADE', 'CASCADE');
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
