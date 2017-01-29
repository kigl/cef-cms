<?php

use yii\db\Migration;

class m160902_063342_user extends Migration
{
    public $tableName = '{{%user}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'login' => $this->string(50),
            'surname' => $this->string(100),
            'name' => $this->string(100),
            'lastname' => $this->string(100),
            'email' => $this->string(50),
            'password' => $this->string(),
            'status' => $this->integer()->defaultValue(0),
            'ip' => $this->string(50),
        ]);

        $this->execute("ALTER TABLE {$this->tableName} ADD `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `status`;");
        $this->execute("ALTER TABLE {$this->tableName} ADD `update_time` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `create_time`;");

        $this->createIndex('ix-user-login', $this->tableName, 'login', true);
        $this->createIndex('ix-user-email', $this->tableName, 'email', true);
        $this->createIndex('ix-user-surname', $this->tableName, 'surname');
        $this->createIndex('ix-user-status', $this->tableName, 'status');

        $this->batchInsert($this->tableName,
            ['id', 'login', 'surname', 'name', 'lastname', 'email', 'password', 'status'],
            [
                ['1', 'admin', '', '', '', Yii::$app->security->generatePasswordHash('admin'), '', '1'],
            ]
        );
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
