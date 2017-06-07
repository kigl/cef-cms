<?php

use yii\db\Migration;

class m161025_160030_shop_property_product extends Migration
{
    protected $tableName = '{{%shop_property_product}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'property_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'value' => $this->string(),
        ]);

        $this->addPrimaryKey('', $this->tableName, ['property_id', 'product_id']);

        $this->addForeignKey('fk-product_property-product_id', $this->tableName, 'product_id', '{{%shop_product}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-product_property-property_id', $this->tableName, 'property_id', '{{%shop_property}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
