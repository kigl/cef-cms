<?php

use yii\db\Migration;

class m160825_111921_mn_informationsystem extends Migration
{
    public function up()
    {
			$this->createTable('mn_informationsystem', [
				'id' => $this->string(50),
				'name' => $this->string()->notNull(),
				'description' => $this->string(300)->notNull(),
				'content' => $this->text(),
				'image' => $this->string(),
				'status' => $this->integer(),
				'sort' => $this->integer(),
				'template' => $this->string(50),
				'user_id' => $this->integer(),
				'meta_title' => $this->string(),
				'meta_description' => $this->string(),
        'items_per_page' => $this->integer(),
				'create_time' => $this->integer(),
				'update_time' => $this->integer(),
			]);
			
			$this->addPrimaryKey('id', 'mn_informationsystem', 'id');
    }

    public function down()
    {
        $this->dropTable('mn_informationsystem');

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
