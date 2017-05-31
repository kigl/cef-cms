<?php

use yii\db\Migration;

class m161025_155950_shop_warehouse_product extends Migration
{
    protected $_tableName = '{{%shop_warehouse_product}}';

    public function up()
    {
        $this->createTable($this->_tableName, [
            'id' => $this->primaryKey(),
            'warehouse_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'value' => $this->decimal(12,2)->notNull(),
        ]);

        $this->createIndex('ix-warehouse_warehouse_id', $this->_tableName, 'warehouse_id');
        $this->addForeignKey('fk-warehouse_warehouse_id', $this->_tableName, 'warehouse_id', '{{%shop_warehouse}}', 'id','CASCADE', 'CASCADE');

        $this->createIndex('ix-warehouse_product_id', $this->_tableName, 'product_id');
        $this->addForeignKey('fk-warehouse_product_id', $this->_tableName, 'product_id', '{{%shop_product}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable($this->_tableName);
    }
}
