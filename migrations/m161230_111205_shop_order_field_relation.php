<?php

use yii\db\Migration;

class m161230_111205_shop_order_field_relation extends Migration
{
    protected $tablaName = '{{%shop_order_field_relation}}';

    public function up()
    {
        $this->createTable($this->tablaName, [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer(),
            'field_id' => $this->integer(),
        ]);

        $this->createIndex('ix-field_relation', $this->tablaName, 'order_id');
        $this->createIndex('ix-field_relation-field_id', $this->tablaName, 'field_id');

        $this->addForeignKey('fk-field_relation-order_id', $this->tablaName, 'order_id', '{{%shop_order}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-field_relation-field_id', $this->tablaName, 'field_id', '{{%shop_order_field}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
       $this->dropTable($this->tablaName);

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
