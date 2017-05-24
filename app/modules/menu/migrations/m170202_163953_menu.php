<?php

use yii\db\Migration;

class m170202_163953_menu extends Migration
{
    protected $_tableName = '{{%menu}}';

    public function up()
    {
        $this->createTable($this->_tableName, [
            'id' => $this->primaryKey(),
            'site_id' => $this->integer(),
            'name' => $this->string(100),
            'class' => $this->string(100),
            'attribute_id' => $this->string(100),
        ]);

        $this->createIndex('ix-menu-name', $this->_tableName, 'name');
        $this->createIndex('ix-menu-site_id', $this->_tableName, 'site_id');

        $this->addForeignKey('fk-menu-site_id', $this->_tableName, 'site_id', '{{%site}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable($this->_tableName);

        return false;
    }
}
