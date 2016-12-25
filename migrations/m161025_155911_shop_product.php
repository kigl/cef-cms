<?php

use yii\db\Migration;

class m161025_155911_shop_product extends Migration
{
    public $tableName = '{{%shop_product}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'group_id' => $this->integer()->defaultValue(0),
            'code' => $this->string(),
            'name' => $this->string()->notNull(),
            'description' => $this->string(),
            'content' => $this->text(),
            'sku' => $this->integer()->defaultValue(0),
            'price' => $this->float(5,2),
            'discount' => $this->float(),
            'status' => $this->integer()->defaultValue(1),
            'user_id' => $this->integer(),
            'alias' => $this->string(),
            'meta_title' => $this->string(),
            'meta_description' => $this->string(),
        ]);

        $this->execute("ALTER TABLE {$this->tableName} ADD `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `meta_description`;");
        $this->execute("ALTER TABLE {$this->tableName} ADD `update_time` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `create_time`;");

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
