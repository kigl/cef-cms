<?php

use yii\db\Migration;

class m161025_160030_shop_property_product extends Migration
{
    protected $tableName = '{{%shop_property_product}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'property_id' => $this->integer(),
            'product_id' => $this->integer(),
            'value' => $this->string(),
        ]);

        $this->createIndex('ix-product_property-product_id', $this->tableName, 'product_id');
        $this->createIndex('ix-product_property-property_id', $this->tableName, 'property_id');

        $this->addForeignKey('fk-product_property-product_id', $this->tableName, 'product_id', '{{%shop_product}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-product_property-property_id', $this->tableName, 'property_id', '{{%shop_property}}', 'id', 'CASCADE', 'CASCADE');
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
