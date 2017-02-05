<?php

use yii\db\Migration;

class m170202_164020_service_menu_item extends Migration
{
    protected $tableName = '{{%service_menu_item}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(),
            'menu_id' => $this->integer(),
            'name' => $this->string(),
            'url' => $this->string(),
            'visible' => $this->integer(),
            'class' => $this->string(100),
            'icon_class' => $this->string(),
            'position' => $this->integer(),
        ]);

        $this->createIndex('ix-menu_item-menu_id', $this->tableName, 'menu_id');

        $this->addForeignKey('fk-menu_item-menu_id', $this->tableName, 'menu_id', '{{%service_menu}}', 'id', 'CASCADE', 'CASCADE');
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
