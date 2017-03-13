<?php

use yii\db\Migration;

class m170313_110815_property_value extends Migration
{
    protected $tableName = '{{%property_value}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'property_id' => $this->integer(),
            'entity_id' => $this->integer(),
            'value' => $this->string(),
        ]);

        $this->createIndex('ix-property_value-property_id', $this->tableName, 'property_id');
        $this->createIndex('ix-property_value-entity_id', $this->tableName, 'entity_id');

        $this->addForeignKey('fk-property_value-property_id', $this->tableName, 'property_id', '{{%property}}', 'id', 'CASCADE', 'CASCADE');
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
