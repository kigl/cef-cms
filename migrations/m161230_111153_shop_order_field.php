<?php

use yii\db\Migration;

class m161230_111153_shop_order_field extends Migration
{
    protected $tableName = '{{%shop_order_field}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->unique(),
            'type' => $this->integer(),
            'required' => $this->integer(),
        ]);

        $this->createIndex('ix-order_field-name', $this->tableName, 'name');
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
