<?php

use yii\db\Migration;

class m170228_044745_comment extends Migration
{
    protected $_tableName = '{{%comment}}';

    public function up()
    {
        $this->createTable($this->_tableName, [
            'id' => $this->primaryKey(),
            'site_id' => $this->integer(),
            'parent_id' => $this->integer(),
            'model_class' => $this->string(),
            'item_id' => $this->integer(),
            'content' => $this->text(),
            'status' => $this->integer(),
            'user_id' => $this->integer(),
        ]);

        $this->execute("ALTER TABLE {$this->_tableName} ADD `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `user_id`;");
        $this->execute("ALTER TABLE {$this->_tableName} ADD `update_time` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `create_time`;");

        $this->createIndex('ix-comment-site_id', $this->_tableName, 'site_id');
        $this->createIndex('ix-comment-user_id', $this->_tableName, 'user_id');

        $this->addForeignKey('fk-comment-user_id', $this->_tableName, 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable($this->_tableName);
    }
}
