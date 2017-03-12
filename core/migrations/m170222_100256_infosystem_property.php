<?php

use yii\db\Migration;

class m170222_100256_infosystem_property extends Migration
{
    protected $tableName = '{{%infosystem_property}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'infosystem_id' => $this->string(100),
            'name' => $this->string(),
            'description' => $this->string(),
            'type' => $this->integer(),
            'sorting' => $this->integer()->defaultValue(500),
            'required' => $this->integer(),
        ]);

        $this->createIndex('ix-infosystem_property-infosystem_id', $this->tableName, 'infosystem_id');
        $this->addForeignKey('fk-infosystem_property-infosystem_id', $this->tableName, 'infosystem_id', '{{%infosystem}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
