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
            'group_on_page' => $this->integer(),
            'product_on_page' => $this->integer(),
            'template' => $this->string(),
            'template_group' => $this->string(),
            'template_product' => $this->string(),
            'max_width_image_preview_group' => $this->integer(),
            'max_height_image_preview_group' => $this->integer(),
            'max_width_image_group' => $this->integer(),
            'max_height_image_group' => $this->integer(),
            'max_width_image_product' => $this->integer(),
            'max_height_image_product' => $this->integer(),
            'sorting_type_group' => $this->integer(),
            'sorting_field_group' => $this->string(),
            'sorting_list_field_group' => $this->string(),
            'sorting_type_product' => $this->integer(),
            'sorting_field_product' => $this->string(),
            'sorting_list_field_product' => $this->string(),
            'meta_title' => $this->string(),
            'meta_description' => $this->string(500),
            'meta_keyword' => $this->string(),
        ]);

        $this->execute("ALTER TABLE {$this->_tableName} ADD `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `meta_keyword`;");
        $this->execute("ALTER TABLE {$this->_tableName} ADD `update_time` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `create_time`;");
    }

    public function down()
    {
        $this->dropTable($this->_tableName);
    }

}
