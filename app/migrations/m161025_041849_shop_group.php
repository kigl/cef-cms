<?php

use yii\db\Migration;

class m161025_041849_shop_group extends Migration
{
    public $tableName = '{{%shop_group}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer()->defaultValue(0),
            'name' => $this->string()->notNull(),
            'description' => $this->string(),
            'content' => $this->text(),
            'image' => $this->string(),
            'image_small' => $this->string(),
            'status' => $this->integer()->defaultValue(1),
            'sort' => $this->integer(),
            'user_id' => $this->integer(),
            'alias' => $this->string(),
            'meta_title' => $this->string(),
            'meta_description' => $this->string(),
            'create_time' => $this->timestamp()->defaultValue(null),
            'update_time' => $this->timestamp()->defaultValue(null),
        ]);

        $this->createIndex('ix-shop_group-parent_id', $this->tableName, 'parent_id');
        $this->createIndex('ix-shop_group-name', $this->tableName, 'name');
        $this->createIndex('ix-shop_group-alias', $this->tableName, 'alias');
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
