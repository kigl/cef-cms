<?php

use yii\db\Migration;

class m170202_164020_create_table_item_menu extends Migration
{
    protected $tableName = '{{%menu_item}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'menu_id' => $this->integer(),
            'name' => $this->string(),
            'url' => $this->string(),
            'visible' => $this->integer(),
            'class' => $this->string(100),
            'icon_class' => $this->string(),
            'position' => $this->integer(),
        ]);
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
