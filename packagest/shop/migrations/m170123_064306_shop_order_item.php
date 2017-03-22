<?php

use yii\db\Migration;

class m170123_064306_shop_order_item extends Migration
{
    protected $tableName = '{{%shop_order_item}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer(),
            'name' => $this->string(),
            'qty' => $this->float(5,2),
            'price' => $this->float(5,2),
        ]);

        $this->createIndex('ix-shop_order_items-order_id', $this->tableName, 'order_id');
        $this->addForeignKey('fk-shop_order_item-order_id', $this->tableName, 'order_id', '{{%shop_order}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        return $this->dropTable($this->tableName);
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
