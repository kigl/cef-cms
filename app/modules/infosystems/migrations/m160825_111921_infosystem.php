<?php

use yii\db\Migration;

class m160825_111921_infosystem extends Migration
{
    protected $_tableName = '{{%infosystem}}';

    public function up()
    {
        $this->createTable($this->_tableName, [
            'id' => $this->primaryKey(),
            'site_id' => $this->integer(),
            'code' => $this->string(),
            'name' => $this->string()->notNull(),
            'description' => $this->string(500),
            'image' => $this->string(),
            'content' => $this->text(),
            'indexing' => $this->integer(),
            'group_on_page' => $this->integer(),
            'item_on_page' => $this->integer(),
            'template' => $this->string(),
            'template_group' => $this->string(),
            'template_item' => $this->string(),
            'template_tag' => $this->string(),
            'max_width_image_preview_group' => $this->integer(),
            'max_height_image_preview_group' => $this->integer(),
            'max_width_image_group' => $this->integer(),
            'max_height_image_group' => $this->integer(),
            'max_width_image_preview_item' => $this->integer(),
            'max_height_image_preview_item' => $this->integer(),
            'max_width_image_item' => $this->integer(),
            'max_height_image_item' => $this->integer(),
            'sorting_type_group' => $this->integer(),
            'sorting_field_group' => $this->string(),
            'sorting_list_field_group' => $this->string(),
            'sorting_type_item' => $this->integer(),
            'sorting_field_item' => $this->string(),
            'sorting_list_field_item' => $this->string(),
            'user_id' => $this->integer(),
            'meta_title' => $this->string(),
            'meta_description' => $this->string(),
            'meta_keyword' => $this->string(),
        ]);

        $this->execute("ALTER TABLE {$this->_tableName} ADD `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `meta_keyword`;");
        $this->execute("ALTER TABLE {$this->_tableName} ADD `update_time` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `create_time`;");

        $this->createIndex('ix-infosystem-site_id', $this->_tableName, 'site_id');
    }

    public function down()
    {
        $this->dropTable($this->_tableName);

        return false;
    }
}
