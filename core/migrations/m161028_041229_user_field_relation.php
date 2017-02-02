<?php

use yii\db\Migration;

class m161028_041229_user_field_relation extends Migration
{
    protected $tableName = '{{%user_field_relation}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'field_id' => $this->integer(),
            'value' => $this->string(),
        ]);

        $this->createIndex('ix-user_field_relation-user_id', $this->tableName, ['user_id', 'field_id'], true);

        $this->addForeignKey('fk-user_field_relation-user_id', $this->tableName, 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-user_field_relation-field_id', $this->tableName, 'field_id', '{{%user_field}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
