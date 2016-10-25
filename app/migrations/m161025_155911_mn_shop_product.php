<?php

use yii\db\Migration;

class m161025_155911_mn_shop_product extends Migration
{
    public $tableName = 'mn_shop_product';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'group_id' => $this->integer(),
            'code' => $this->string(),
            'name' => $this->string(),
            'description' => $this->string(),
            'content' => $this->text(),
            'depot' => $this->integer(),
            'price' => $this->decimal(5, 2),
            'user_id' => $this->integer(),
            'create_time' => $this->timestamp()->defaultValue(null),
            'update_time' => $this->timestamp()->defaultValue(null),
        ]);
        
        $this->createIndex('name', $this->tableName, 'name');
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
