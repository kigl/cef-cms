<?php

use yii\db\Migration;

class m160825_111921_informationsystem extends Migration
{
    public $tableName = '{{%informationsystem}}';

    public function up()
    {
			$this->createTable($this->tableName, [
				'id' => $this->primaryKey(),
				'name' => $this->string()->notNull(),
				'description' => $this->string(300)->notNull(),
				'content' => $this->text(),
				'image' => $this->string(),
				'sort' => $this->integer(),
				'template' => $this->string(50),
				'user_id' => $this->integer(),
				'meta_title' => $this->string(),
				'meta_description' => $this->string(),
                'item_on_page' => $this->integer(),
			]);

		$this->execute("ALTER TABLE {$this->tableName} ADD `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `item_on_page`;");
		$this->execute("ALTER TABLE {$this->tableName} ADD `update_time` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `create_time`;");

			$this->createIndex('ix-informationsystem-name', $this->tableName, 'name');
    }

    public function down()
    {
        $this->dropTable($this->tableName);

        return false;
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
