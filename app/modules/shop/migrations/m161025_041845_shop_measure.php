<?php

use yii\db\Migration;

class m161025_041845_shop_measure extends Migration
{
    protected $_tableName = '{{%shop_measure}}';

    public function up()
    {
        $this->createTable($this->_tableName, [
            'id' => $this->primaryKey(),
            'site_id' => $this->integer()->notNull(),
            'code' => $this->string(),
            'short_name' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
        ]);

        $this->createIndex('ix-measure-site_id', $this->_tableName, 'site_id');
        $this->addForeignKey('fk-measure-site_id', $this->_tableName, 'site_id', '{{%site}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable($this->_tableName);
    }
}
