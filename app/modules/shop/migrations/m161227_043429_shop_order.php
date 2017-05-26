<?php

use yii\db\Migration;

class m161227_043429_shop_order extends Migration
{
    public $tableName = '{{%shop_order}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'shop_id' => $this->integer(),
            'status' => $this->integer()->defaultValue(0),
            'sum' => $this->decimal(12, 2),
            'user_id' => $this->integer(),
            'country' => $this->string(),
            'region' => $this->string(),
            'city' => $this->string(),
            'postcode' => $this->integer(),
            'address' => $this->string(),
            'company' => $this->string(),
            'phone' => $this->string(),
            'comment' => $this->string(),
        ]);

        $this->execute("ALTER TABLE {$this->tableName} ADD `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `comment`;");
        $this->execute("ALTER TABLE {$this->tableName} ADD `update_time` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `create_time`;");

        $this->createIndex('ix-order-status', $this->tableName, 'status');
        $this->createIndex('ix-order-user_id', $this->tableName, 'user_id');

        $this->addForeignKey('fk-order-user_id', $this->tableName, 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
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
