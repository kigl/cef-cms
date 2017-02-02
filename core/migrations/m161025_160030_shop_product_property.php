<?php

use yii\db\Migration;

class m161025_160030_shop_product_property extends Migration
{
    protected $tableName = '{{%shop_product_property}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'property_id' => $this->integer(),
            'value' => $this->string(),
        ]);

        $this->createIndex('ix-product_modification-product_id', $this->tableName, 'product_id');
        $this->createIndex('ix-product_modification-property_id', $this->tableName, 'property_id');

        $this->addForeignKey('fk-property-product_id', $this->tableName, 'product_id', '{{%shop_product}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-property-property_id', $this->tableName, 'property_id', '{{%shop_property}}', 'id', 'CASCADE', 'CASCADE');
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
