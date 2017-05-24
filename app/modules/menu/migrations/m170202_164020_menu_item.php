<?php

use yii\db\Migration;

class m170202_164020_menu_item extends Migration
{
    protected $tableName = '{{%menu_item}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(),
            'menu_id' => $this->integer(),
            'name' => $this->string(),
            'name_hide' => $this->integer()->defaultValue(0),
            'active' => $this->integer(),
            'visible' => $this->integer(),
            'url' => $this->string(),
            'sorting' => $this->integer()->defaultValue(500),
            'image' => $this->string(),
            'item_class' => $this->string(100),
            'item_id' => $this->string(100),
            'item_icon_class' => $this->string(),
            'link_class' => $this->string(100),
            'link_id' => $this->string(100),
        ]);

        $this->execute("ALTER TABLE {$this->tableName} ADD `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `link_id`;");
        $this->execute("ALTER TABLE {$this->tableName} ADD `update_time` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `create_time`;");

        $this->createIndex('ix-menu_item-menu_id', $this->tableName, 'menu_id');

        $this->addForeignKey('fk-menu_item-menu_id', $this->tableName, 'menu_id', '{{%menu}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable($this->tableName);

        return false;
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
