<?php

use yii\db\Migration;

class m161025_160030_mn_shop_product_property extends Migration
{
    protected $tableName = 'mn_shop_product_property';

    public function up()
    {
        $this->createTable($this->tableName, [
            'product_id' => $this->integer(),
            'property_id' => $this->integer(),
            'value' => $this->string(),
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
