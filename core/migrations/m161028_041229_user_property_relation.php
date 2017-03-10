<?php

use yii\db\Migration;

class m161028_041229_user_property_relation extends Migration
{
    protected $tableName = '{{%user_property_relation}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'property_id' => $this->integer(),
            'value' => $this->string(),
        ]);

        $this->createIndex('ix-user_field_property-user_id', $this->tableName, ['user_id', 'property_id'], true);

        $this->addForeignKey('fk-user_field_property-user_id', $this->tableName, 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-user_field_property-property_id', $this->tableName, 'property_id', '{{%user_property}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
