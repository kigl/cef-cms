<?php

use yii\db\Migration;

class m161025_041849_shop_group extends Migration
{
    protected $_tableName = '{{%shop_group}}';

    public function up()
    {
        $this->createTable($this->_tableName, [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(),
            'shop_id' => $this->integer(),
            'name' => $this->string()->notNull(),
            'description' => $this->string(),
            'content' => $this->text(),
            'image_preview' => $this->string(),
            'image' => $this->string(),
            'sorting' => $this->integer(),
            'active' => $this->integer(1),
            'user_id' => $this->integer(),
            'alias' => $this->string(),
            'meta_title' => $this->string(),
            'meta_description' => $this->string(),
            'meta_keyword' => $this->string(),
        ]);

        $this->execute("ALTER TABLE {$this->_tableName} ADD `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `meta_keyword`;");
        $this->execute("ALTER TABLE {$this->_tableName} ADD `update_time` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `create_time`;");
    }

    public function down()
    {
        $this->dropTable($this->_tableName);
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
