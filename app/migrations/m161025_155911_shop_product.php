<?php

use yii\db\Migration;

class m161025_155911_shop_product extends Migration
{
    public $tableName = 'mn_shop_product';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'group_id' => $this->integer()->defaultValue(0),
            'code' => $this->string(),
            'name' => $this->string()->notNull(),
            'description' => $this->string(),
            'content' => $this->text(),
            'depot' => $this->integer(),
            'price' => $this->decimal(5, 2),
            'status' => $this->integer()->defaultValue(1),
            'user_id' => $this->integer(),
            'alias' => $this->string(),
            'meta_title' => $this->string(),
            'meta_description' => $this->string(),
            'create_time' => $this->timestamp()->defaultValue(null),
            'update_time' => $this->timestamp()->defaultValue(null),
        ]);
        
        $this->createIndex('ix-product-name', $this->tableName, 'name');
        $this->createIndex('ix-product-group_id', $this->tableName, 'group_id');
        $this->createIndex('ix-product-code', $this->tableName, 'code');
        $this->createIndex('ix-product-alias', $this->tableName, 'alias');

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
