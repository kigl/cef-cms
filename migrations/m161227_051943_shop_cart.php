<?php

use yii\db\Migration;

class m161227_051943_shop_cart extends Migration
{
    public $tableName = '{{%shop_cart}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
        ]);

        $this->createIndex('ix-shop_cart-user_id', $this->tableName, 'user_id');

        $this->addForeignKey('fk-shop_cart-user_id', $this->tableName, 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable($this->tableName);

        return false;
    }
}
