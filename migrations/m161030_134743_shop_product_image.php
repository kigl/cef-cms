<?php

use yii\db\Migration;

class m161030_134743_shop_product_image extends Migration
{

    protected $tableName = '{{%shop_product_image}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'name' => $this->string(),
            'status' => $this->integer()->defaultValue(0),
            'alt' => $this->string(),
            'create_time' => $this->timestamp(),
        ]);

        $this->createIndex('ix-product_image-product_id', $this->tableName, 'product_id');
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
