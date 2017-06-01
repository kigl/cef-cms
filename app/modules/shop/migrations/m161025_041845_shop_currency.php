<?php

use yii\db\Migration;

class m161025_041845_shop_currency extends Migration
{
    protected $_tableName = '{{%shop_currency}}';

    public function up()
    {
        $this->createTable($this->_tableName, [
            'id' => $this->primaryKey(),
            'site_id' => $this->integer(),
            'short_name' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'code' => $this->string()->notNull(),
            'exchange_rate' => $this->decimal(8, 6)->notNull(),
        ]);

        $this->createIndex('ix-currency-site_id', $this->_tableName, 'site_id');
        $this->addForeignKey('fk-currency-site_id', $this->_tableName, 'site_id', '{{%site}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable($this->_tableName);
    }
}
