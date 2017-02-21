<?php

use yii\db\Migration;

class m160825_111921_infosystem extends Migration
{
    public $tableName = '{{%infosystem}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->string(100),
            'name' => $this->string(),
            'description' => $this->string()->notNull(),
            'content' => $this->text(),
            'item_on_page' => $this->integer(),
            'template_group' => $this->string(),
            'template_item' => $this->string(),
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
