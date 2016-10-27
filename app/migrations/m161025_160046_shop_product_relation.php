<?php

use yii\db\Migration;

class m161025_160046_shop_product_relation extends Migration
{
    protected $tableName = '{{%shop_product_relation}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'product_id' => $this->integer(),
            'product_relation_id' => $this->integer(),
        ]);

        $this->addPrimaryKey('pk-product_relation', $this->tableName, ['product_id', 'product_relation_id']);

        $this->addForeignKey('fk-product_relation-product_id', $this->tableName, 'product_id', '{{%shop_product}}', 'id', 'CASCADE', 'CASCADE');
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
