<?php

use yii\db\Migration;

class m161028_041229_user_field_relation extends Migration
{
    protected $tableName = '{{%user_field_relation}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'user_id' => $this->integer(),
            'field_id' => $this->integer(),
            'value' => $this->string(),
        ]);

        $this->addPrimaryKey('pk-user_field_relation', $this->tableName, ['user_id', 'field_id']);

        $this->addForeignKey('fk-user_field_relation-user_id', $this->tableName, 'user_id', '{{%user}}', 'id');
        $this->addForeignKey('fk-user_field_relation-field_id', $this->tableName, 'field_id', '{{%user_field}}', 'id');
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
