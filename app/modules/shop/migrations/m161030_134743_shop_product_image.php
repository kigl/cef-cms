<?php

use yii\db\Migration;

class m161030_134743_shop_product_image extends Migration
{

    protected $_tableName = '{{%shop_product_image}}';

    public function up()
    {
        $this->createTable($this->_tableName, [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'name' => $this->string(),
            'status' => $this->integer()->defaultValue(0),
            'sorting' => $this->integer()->defaultValue(500),
            'alt' => $this->string(),
        ]);

        $this->execute("ALTER TABLE {$this->_tableName} ADD `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `alt`;");

        $this->createIndex('ix-product_image-product_id', $this->_tableName, 'product_id');
    }

    public function down()
    {
        $this->dropTable($this->_tableName);
    }
}
