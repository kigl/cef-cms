<?php

use yii\db\Migration;

class m161226_105833_shop_cart extends Migration
{
    public $tableName = '{{%shop_cart}}';

    public function up()
    {
        $this->createTable($this->tableName, [

        ]);
    }

    public function down()
    {
        echo "m161226_105833_shop_cart cannot be reverted.\n";

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
