<?php

use yii\db\Migration;

class m161025_155915_shop_price_product extends Migration
{
    protected $_tableName = '{{%shop_price_product}}';

    public function up()
    {
        $this->createTable($this->_tableName, [
            'id' => $this->primaryKey(),
            'price_id' => $this->integer(),
            'product_id' => $this->integer(),
            'value' => $this->decimal(12,2)->defaultValue(0),
        ]);

        $this->createIndex('ix-product-product_id', $this->_tableName, 'product_id');
        $this->addForeignKey('fk-product-product_id', $this->_tableName, 'product_id', '{{%shop_product}}', 'id',
            'CASCADE', 'CASCADE');

        $this->createIndex('ix-product_price_id', $this->_tableName, 'price_id');
        $this->addForeignKey('fk-product-price_id', $this->_tableName, 'price_id', '{{%shop_price}}', 'id', 'CASCADE',
            'CASCADE');
    }

    public function down()
    {
        $this->dropTable($this->_tableName);
    }
}
