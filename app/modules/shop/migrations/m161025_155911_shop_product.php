<?php

use yii\db\Migration;

class m161025_155911_shop_product extends Migration
{
    protected $_tableName = '{{%shop_product}}';

    public function up()
    {
        $this->createTable($this->_tableName, [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(),
            'group_id' => $this->integer(),
            'shop_id' => $this->integer()->notNull(),
            'active' => $this->integer()->defaultValue(1),
            'sorting' => $this->integer()->defaultValue(0),
            'code' => $this->string(),
            'vendor_code' => $this->string(),
            'name' => $this->string()->notNull()->notNull(),
            'description' => $this->string(500),
            'content' => $this->text(),
            //'producer_id' => $this->integer(),
            'measure_id' => $this->integer(),
            'weight' => $this->decimal(8, 2)->defaultValue(0),
            //'discount' => $this->decimal(8, 2),
            'length' => $this->decimal(12, 2)->defaultValue(0),
            'width' => $this->decimal(12, 2)->defaultValue(0),
            'height' => $this->decimal(12,2)->defaultValue(0),
            'user_id' => $this->integer()->notNull(),
            'alias' => $this->string(),
            'meta_title' => $this->string(),
            'meta_description' => $this->string(),
            'meta_keyword' => $this->string(),
        ]);

        $this->execute("ALTER TABLE {$this->_tableName} ADD `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `meta_keyword`;");
        $this->execute("ALTER TABLE {$this->_tableName} ADD `update_time` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `create_time`;");

        $this->createIndex('ix-product_measure_id', $this->_tableName, 'measure_id');
        $this->addForeignKey('fk-product-measure_id', $this->_tableName, 'measure_id', '{{%shop_measure}}', 'id', 'SET NULL', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable($this->_tableName);
    }
}
