<?php

use yii\db\Migration;

class m170519_041890_template extends Migration
{
    protected $_tableName = '{{%template}}';

    public function up()
    {
        $this->createTable($this->_tableName, [
            'id' => $this->string(),
            'name' => $this->string(),
            'description' => $this->string(500),
            'layout' => $this->string(),
            'version' => $this->string(),
        ]);

        $this->addPrimaryKey('id', $this->_tableName, 'id');
    }

    public function down()
    {
        $this->dropTable($this->_tableName);
    }
}
