<?php

use yii\db\Migration;

class m161227_051943_shop_cart extends Migration
{
    public $tableName = '{{%shop_cart}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer(),
            'product_id' => $this->integer(),
            'qty' => $this->integer()->defaultValue(0),
            'price' => $this->float(5, 2),
        ]);

        $this->createIndex('ix-order_product-order_id', $this->tableName, 'order_id');
        $this->createIndex('ix-order_product-product_id', $this->tableName, 'product_id');

        $this->addForeignKey('fk-order_product-order_id', $this->tableName, 'order_id', '{{%shop_order}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-order_product-product_id', $this->tableName, 'product_id', '{{%shop_product}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable($this->tableName);

        return false;
    }
}
