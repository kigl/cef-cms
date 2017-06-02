<?php

use yii\db\Migration;

class m161025_155949_shop_property extends Migration
{
    protected $_tableName = '{{%shop_property}}';

    public function up()
    {
        $this->createTable($this->_tableName, [
            'id' => $this->primaryKey(),
            'shop_id' => $this->integer(),
            'name' => $this->string(),
            'description' => $this->string(),
            'type' => $this->integer(),
            'sorting' => $this->integer()->defaultValue(500),
            'required' => $this->integer()->defaultValue(0),
            'list_id' => $this->integer(),
        ]);

        $this->createIndex('ix-shop_property-shop_id', $this->_tableName, 'shop_id');
        $this->addForeignKey('fk-shop_property_shop_id', $this->_tableName, 'shop_id', '{{%shop}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable($this->_tableName);
    }
}
