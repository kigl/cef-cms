<?php

use yii\db\Migration;

class m161025_160046_shop_product_modification extends Migration
{
    protected $tableName = '{{%shop_product_modification}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'product_modification_id' => $this->integer(),
        ]);

        $this->createIndex('ix-product_modification-product_id', $this->tableName, ['product_id', 'product_modification_id'], true);
        $this->createIndex('ix-product_modification-product_modification_id', $this->tableName, 'product_modification_id');

        $this->addForeignKey('fk-product_modification-product_id', $this->tableName, 'product_id', '{{%shop_product}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-product_modification-product_modification_id', $this->tableName, 'product_modification_id', '{{%shop_product}}', 'id', 'CASCADE', 'CASCADE');

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
