<?php

use yii\db\Migration;

class m161028_041210_user_property extends Migration
{
    protected $tableName = '{{%user_property}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'description' => $this->string(),
            'type' => $this->integer(),
            'sorting' => $this->integer()->defaultValue(500),
            'required' => $this->integer()->defaultValue(0),
        ]);

        $this->createIndex('ix-property-name', $this->tableName, 'name');
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
