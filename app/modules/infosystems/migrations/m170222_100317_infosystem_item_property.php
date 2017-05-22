<?php

use yii\db\Migration;

class m170222_100317_infosystem_item_property extends Migration
{
    protected $tableName = '{{%infosystem_item_property}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'item_id' => $this->integer(),
            'property_id' => $this->integer(),
            'value' => $this->string(),
        ]);

        $this->createIndex('ix-infosystem_item_property-item_id-property_id', $this->tableName, ['item_id', 'property_id'], true);
        $this->addForeignKey('fk-infosystem_property-item_id', $this->tableName, 'item_id', '{{%infosystem_item}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-infosystem_property-property_id', $this->tableName, 'property_id', '{{%infosystem_property}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
