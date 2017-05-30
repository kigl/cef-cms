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
            'code' => $this->string(),
            'name' => $this->string(),
            'description' => $this->string(500),
            'content' => $this->text(),
            'image' => $this->string(),
            'product_weight_measure_id' => $this->integer(),
            'product_size_measure_id' => $this->integer(),
            'group_on_page' => $this->integer(),
            'product_on_page' => $this->integer(),
            'template' => $this->string(),
            'template_group' => $this->string(),
            'template_product' => $this->string(),
            'group_image_preview_max_width' => $this->integer(),
            'group_image_preview_max_height' => $this->integer(),
            'group_image_max_width' => $this->integer(),
            'group_image_max_height' => $this->integer(),
            'product_image_preview_max_width' => $this->integer(),
            'product_image_preview_max_height' => $this->integer(),
            'product_image_max_width' => $this->integer(),
            'product_image_max_height' => $this->integer(),
            'group_sorting_type' => $this->integer(),
            'group_sorting_field' => $this->string(),
            'group_sorting_list_field' => $this->string(),
            'product_sorting_type' => $this->integer(),
            'product_sorting_field' => $this->string(),
            'product_sorting_list_field' => $this->string(),
            'user_id' => $this->integer(),
            'meta_title' => $this->string(),
            'meta_description' => $this->string(),
            'meta_keyword' => $this->string(),
        ]);

        $this->execute("ALTER TABLE {$this->_tableName} ADD `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `meta_keyword`;");
        $this->execute("ALTER TABLE {$this->_tableName} ADD `update_time` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `create_time`;");

        $this->createIndex('ix-shop-weight_measure_id', $this->_tableName, 'product_weight_measure_id');
        $this->addForeignKey('fk-shop-weight_measure_id', $this->_tableName, 'product_weight_measure_id', '{{%shop_measure}}', 'id', 'SET NULL', 'SET NULL');

        $this->createIndex('ix-shop-size_measure_id', $this->_tableName, 'product_size_measure_id');
        $this->addForeignKey('fk-shop-size_measure_id', $this->_tableName, 'product_size_measure_id', '{{%shop_measure}}', 'id', 'SET NULL', 'SET NULL');
    }

    public function down()
    {
        $this->dropTable($this->_tableName);
    }

}
