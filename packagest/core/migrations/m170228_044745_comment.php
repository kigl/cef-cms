<?php

use yii\db\Migration;

class m170228_044745_comment extends Migration
{
    protected $tableName = '{{%comment}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(),
            'model_class' => $this->string(),
            'item_id' => $this->integer(),
            'content' => $this->text(),
            'status' => $this->integer(),
            'user_id' => $this->integer(),
        ]);

        $this->execute("ALTER TABLE {$this->tableName} ADD `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `user_id`;");
        $this->execute("ALTER TABLE {$this->tableName} ADD `update_time` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `create_time`;");

        $this->createIndex('ix-comment-parent_id', $this->tableName, 'parent_id');
        $this->createIndex('ix-comment-model_class', $this->tableName, 'model_class');
        $this->createIndex('ix-comment-item_id', $this->tableName, 'item_id');
        $this->createIndex('ix-comment-status', $this->tableName, 'status');
        $this->createIndex('ix-comment-user_id', $this->tableName, 'user_id');

        $this->addForeignKey('fk-comment-user_id', $this->tableName, 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
