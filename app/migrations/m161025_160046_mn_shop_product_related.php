<?php

use yii\db\Migration;

class m161025_160046_mn_shop_product_related extends Migration
{
    protected $tableName = 'mn_shop_product_related';

    public function up()
    {
        $this->createTable($this->tableName, [
            'product_id' => $this->integer(),
            'product_related_id' => $this->integer(),
        ]);
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
