<?php

use yii\db\Migration;

class m170202_163953_create_table_menu extends Migration
{
    protected $tableName = '{{%menu}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'name' => $this->string(100),
            'class' => $this->string(100),
            'attribute_id' => $this->string(100),
        ]);

        $this->createIndex('ix-menu-name', $this->tableName, 'name');
    }

    public function down()
    {
        $this->dropTable($this->tableName);

        return false;
    }
}
