<?php

use yii\db\Migration;

class m161025_041849_shop_group extends Migration
{
    public $tableName = 'mn_shop_group';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(),
            'name' => $this->string(),
            'description' => $this->string(),
            'content' => $this->text(),
            'image' => $this->string(),
            'image_small' => $this->string(),
            'status' => $this->integer(),
            'sort' => $this->integer(),
            'user_id' => $this->integer(),
            'create_time' => $this->timestamp(),
            'update_time' => $this->timestamp(),
        ]);
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
