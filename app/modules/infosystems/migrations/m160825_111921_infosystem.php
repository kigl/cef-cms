<?php

use yii\db\Migration;

class m160825_111921_infosystem extends Migration
{
    public $tableName = '{{%infosystem}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->string(100),
            'name' => $this->string()->notNull(),
            'description' => $this->string(),
            'content' => $this->text(),
            'site_id' => $this->integer(),
            'indexing' => $this->integer(),
            'group_on_page' => $this->integer(),
            'item_on_page' => $this->integer(),
            'template' => $this->string(),
            'template_group' => $this->string(),
            'template_item' => $this->string(),
            'template_tag' => $this->string(),
            'max_width_image_description_group' => $this->integer(),
            'max_height_image_description_group' => $this->integer(),
            'max_width_image_content_group' => $this->integer(),
            'max_height_image_content_group' => $this->integer(),
            'max_width_image_description_item' => $this->integer(),
            'max_height_image_description_item' => $this->integer(),
            'max_width_image_content_item' => $this->integer(),
            'max_height_image_content_item' => $this->integer(),
            'sorting_type_group' => $this->integer(),
            'sorting_field_group' => $this->string(100),
            'sorting_list_field_group' => $this->string(),
            'sorting_type_item' => $this->integer(),
            'sorting_field_item' => $this->string(100),
            'sorting_list_field_item' => $this->string(),
            'user_id' => $this->integer(),
            'meta_title' => $this->string(),
            'meta_description' => $this->string(),
        ]);

        $this->addPrimaryKey('infosystem_id', $this->tableName, 'id');

        $this->execute("ALTER TABLE {$this->tableName} ADD `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `meta_description`;");
        $this->execute("ALTER TABLE {$this->tableName} ADD `update_time` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `create_time`;");
    }

    public function down()
    {
        $this->dropTable($this->tableName);

        return false;
    }
}
