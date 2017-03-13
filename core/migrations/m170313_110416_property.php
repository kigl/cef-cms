<?php

use yii\db\Migration;

class m170313_110416_property extends Migration
{
    public $tableName = '{{%property}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'description' => $this->string(),
            'required' => $this->integer(),
            'sorting' => $this->integer()->defaultValue(500),
            'type' => $this->integer(),
            'infosystem_id' => $this->string(),
            'model_class' => $this->string(),
            'list_id' => $this->integer(),
        ]);

        $this->execute("ALTER TABLE {$this->tableName} ADD `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `list_id`;");
        $this->execute("ALTER TABLE {$this->tableName} ADD `update_time` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `create_time`;");

        $this->createIndex('ix-property-sorting', $this->tableName, 'sorting');
        $this->createIndex('ix-property-type', $this->tableName, 'type');
        $this->createIndex('ix-property-infosystem_id', $this->tableName, 'infosystem_id');
        $this->createIndex('ix-property-model_class', $this->tableName, 'model_class');

        $this->addForeignKey('fk-property-infosystem_id', $this->tableName, 'infosystem_id', '{{%infosystem}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
