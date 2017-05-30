<?php

use yii\db\Migration;

class m161025_041850_shop_price extends Migration
{
    protected $_tableName = '{{%shop_price}}';

    public function up()
    {
        $this->createTable($this->_tableName, [
            'id' => $this->primaryKey(),
            'shop_id' => $this->integer(),
            'name' => $this->string(),
            'description' => $this->string(),
        ]);

        $this->createIndex('ix-shop_price-shop_id', $this->_tableName, 'shop_id');
        $this->addForeignKey('fk-shop_price-shop_id', $this->_tableName, 'shop_id', '{{%shop}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable($this->_tableName);
    }
}
