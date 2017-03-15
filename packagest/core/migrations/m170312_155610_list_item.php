<?php

use yii\db\Migration;

class m170312_155610_list_item extends Migration
{
    protected $tableName = '{{%list_item}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'list_id' => $this->integer(),
            'value' => $this->string(),
            'description' => $this->string(),
            'sorting' => $this->integer()->defaultValue(500),
        ]);

        $this->createIndex('ix-list_item-list_id', $this->tableName, 'list_id');

        $this->addForeignKey('fk-list_item_list_id', $this->tableName, 'list_id', '{{%list}}', 'id', 'CASCADE', 'CASCADE');
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
