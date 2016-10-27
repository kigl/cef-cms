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
				'create_time' => $this->timestamp()->defaultValue(null),
				'update_time' => $this->timestamp()->defaultValue(null),
			]);

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
