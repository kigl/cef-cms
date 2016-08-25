<?php

use yii\db\Migration;

class m160825_111921_mn_informationsystem extends Migration
{
    public function up()
    {
			$this->createTable('mn_informatonsystem', [
				'id' => $this->primaryKey(),
				'name' => $this->string()->notNull(),
				'description' => $this->string(300)->notNull(),
				'content' => $this->text(),
				'image' => $this->string(),
				'status' => $this->integer(),
				'sort' => $this->integer(),
				'seo_title' => $this->string(),
				'seo_description' => $this->string(),
				'user_id' => $this->integer(),
				'create_time' => $this->integer(),
				'update_time' => $this->integer(),
			]);
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
