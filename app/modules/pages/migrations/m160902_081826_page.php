<?php

use yii\db\Migration;

class m160902_081826_page extends Migration
{
	protected $_tableName = '{{%page}}';
	
    public function up()
    {
			$this->createTable($this->_tableName, [
				'id' => $this->primaryKey(),
                'site_id' => $this->integer(),
				'name' => $this->string(),
				'content' => $this->text(),
				'indexing' => $this->integer(),
				'template' => $this->string(),
				'alias' => $this->string(),
				'meta_title' => $this->string(),
				'meta_description' => $this->string(),
			]);

        $this->execute("ALTER TABLE {$this->_tableName} ADD `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `meta_description`;");
        $this->execute("ALTER TABLE {$this->_tableName} ADD `update_time` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `create_time`;");

        $this->createIndex('ix-page-site_id', $this->_tableName, 'site_id');

        $this->addForeignKey('fk-page-site_id', $this->_tableName, 'site_id', '{{%site}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
			$this->dropTable($this->_tableName);
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
