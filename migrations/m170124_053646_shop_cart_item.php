<?php

use yii\db\Migration;

class m170124_053646_shop_cart_item extends Migration
{
    public $tableName = '{{%shop_cart_item}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'cart_id' => $this->integer(),
            'product_id' => $this->integer(),
            'qty' => $this->integer()->defaultValue(0),
            'price' => $this->float(5, 2),
        ]);

        $this->createIndex('ix-order_product-cart_id', $this->tableName, 'cart_id');
        $this->createIndex('ix-order_product-product_id', $this->tableName, 'product_id');

        $this->addForeignKey('fk-shop_cart-cart_id', $this->tableName, 'cart_id', '{{%shop_cart}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-order_product-product_id', $this->tableName, 'product_id', '{{%shop_product}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable($this->tableName);

        return false;
    }
}
