<?php

use yii\db\Migration;

class m170531_050525_shop_product_packing extends Migration
{
    protected $_tableName = '{{%shop_product_packing}}';

    public function up()
    {
        $this->createTable($this->_tableName, [
            'id' => $this->primaryKey(),
            'measure_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'main' => $this->integer(),
            'name' => $this->string()->notNull(),
            'value' => $this->decimal(8, 2)->notNull(),
            'length' => $this->decimal(8, 2)->defaultValue(0),
            'width' => $this->decimal(8, 2)->defaultValue(0),
            'height' => $this->decimal(8, 2)->defaultValue(0),
        ]);

        $this->createIndex('ix-packing-parent_id', $this->_tableName, 'parent_id');
            $this->addForeignKey('fk-packing-parent_id', $this->_tableName, 'parent_id', $this->_tableName, 'id', 'CASCADE', 'CASCADE');

            $this->createIndex('ix-packing-measure_id', $this->_tableName, 'measure_id');
            $this->addForeignKey('fk-packing-measure_id', $this->_tableName, 'measure_id', '{{%shop_measure}}', 'id', 'CASCADE', 'CASCADE');

            $this->createIndex('ix-packing-product_id', $this->_tableName, 'product_id');
            $this->addForeignKey('fk-packing-product_id', $this->_tableName, 'product_id', '{{%shop_product}}','id','CASCADE', 'CASCADE');

;    }

    public function down()
    {
        $this->dropTable($this->_tableName);
    }
}
