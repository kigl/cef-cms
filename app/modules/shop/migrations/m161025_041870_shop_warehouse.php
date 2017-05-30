<?php

use yii\db\Migration;

class m161025_041870_shop_warehouse extends Migration
{
    protected $_tableName = '{{%shop_warehouse}}';

    public function up()
    {
        $this->createTable($this->_tableName, [
            'id' => $this->primaryKey(),
            'shop_id' => $this->integer(),
            'name' => $this->string(),
            'description' => $this->string(500),
            'country_id' => $this->integer(),
            'region_id' => $this->integer(),
            'city_id' => $this->integer(),
            'address' => $this->string(),
        ]);

        $this->createIndex('ix-shop_warehouse-shop_id', $this->_tableName, 'shop_id');
        $this->addForeignKey('fk-shop_warehouse_shop_id', $this->_tableName, 'shop_id', '{{%shop}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable($this->_tableName);
    }
}
