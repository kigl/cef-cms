<?php

use yii\db\Migration;

class m161025_041848_shop extends Migration
{
    protected $_tableName = '{{%shop}}';

    public function up()
    {
        $this->createTable($this->_tableName, [
            'id' => $this->primaryKey(),
            'site_id' => $this->integer(),
            'code' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'description' => $this->string(500),
            'content' => $this->text(),
            'image' => $this->string(),
            'currency_id' => $this->integer(),
            'weight_measure_id' => $this->integer(),
            'size_packing_measure_id' => $this->integer(),
            'group_on_page' => $this->integer()->notNull(),
            'product_on_page' => $this->integer()->notNull(),
            'template' => $this->string()->notNull(),
            'template_group' => $this->string()->notNull(),
            'template_product' => $this->string()->notNull(),
            'group_image_preview_max_width' => $this->integer()->notNull(),
            'group_image_preview_max_height' => $this->integer()->notNull(),
            'group_image_max_width' => $this->integer()->notNull(),
            'group_image_max_height' => $this->integer()->notNull(),
            'product_image_max_width' => $this->integer()->notNull(),
            'product_image_max_height' => $this->integer()->notNull(),
            'group_sorting_type' => $this->integer()->notNull(),
            'group_sorting_field' => $this->string()->notNull(),
            'group_sorting_list_field' => $this->string()->notNull(),
            'product_sorting_type' => $this->integer()->notNull(),
            'product_sorting_field' => $this->string()->notNull(),
            'product_sorting_list_field' => $this->string()->notNull(),
            'meta_title' => $this->string(),
            'meta_description' => $this->string(),
            'meta_keyword' => $this->string(),
        ]);

        $this->execute("ALTER TABLE {$this->_tableName} ADD `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `meta_keyword`;");
        $this->execute("ALTER TABLE {$this->_tableName} ADD `update_time` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `create_time`;");

        $this->createIndex('ix-shop-currency_id', $this->_tableName, 'currency_id');
        $this->addForeignKey('fk-shop-currency_id', $this->_tableName, 'currency_id', '{{%shop_currency}}', 'id', 'SET NULL', 'SET NULL');

        $this->createIndex('ix-shop-weight_measure_id', $this->_tableName, 'weight_measure_id');
        $this->addForeignKey('fk-shop-weight_measure_id', $this->_tableName, 'weight_measure_id', '{{%shop_measure}}', 'id', 'SET NULL', 'SET NULL');

        $this->createIndex('ix-shop-size_packing_measure_id', $this->_tableName, 'size_packing_measure_id');
        $this->addForeignKey('fk-shop-size_packing_measure_id', $this->_tableName, 'size_packing_measure_id', '{{%shop_measure}}', 'id', 'SET NULL', 'SET NULL');
    }

    public function down()
    {
        $this->dropTable($this->_tableName);
    }

}
