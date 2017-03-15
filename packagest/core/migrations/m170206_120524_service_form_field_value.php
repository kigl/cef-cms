<?php

use yii\db\Migration;

class m170206_120524_service_form_field_value extends Migration
{
    protected $tableName = '{{%service_form_field_value}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'form_completed_id' => $this->integer(),
            'field_id' => $this->integer(),
            'value' => $this->string(),
        ]);

        $this->createIndex('ik-service_form_completed-form_completed', $this->tableName, 'form_completed_id');
        $this->createIndex('ik-service_form_completed-field_id', $this->tableName, 'field_id');

        $this->addForeignKey('fk-service_form_completed-form_completed_id', $this->tableName, 'form_completed_id',
            '{{%service_form_completed}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-service_form_completed-field_id', $this->tableName, 'field_id', '{{%service_form_field}}', 'id',
            'CASCADE', 'CASCADE');
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
