<?php

use yii\db\Migration;

class m170312_155553_list extends Migration
{
    protected $tableName = '{{%list}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'description' => $this->string(),
        ]);

        $this->execute("ALTER TABLE {$this->tableName} ADD `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `description`;");
        $this->execute("ALTER TABLE {$this->tableName} ADD `update_time` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `create_time`;");
    }

    public function down()
    {
        $this->dropTable($this->tableName);
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
