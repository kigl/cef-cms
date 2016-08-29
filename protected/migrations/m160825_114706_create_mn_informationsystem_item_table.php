<?php

use yii\db\Migration;

/**
 * Handles the creation for table `mn_informationsystem_item`.
 */
class m160825_114706_create_mn_informationsystem_item_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('mn_informationsystem_item', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(),
            'item_type' => $this->integer(),
            'informationsystem_id' => $this->integer(),
            'name' => $this->string()->notNull(),
            'description'  => $this->string(300), 
            'content' => $this->text(),
            'image' => $this->string(),
            'status' => $this->integer(),
            'sort' => $this->integer(),
            'user_id' => $this->integer(),
            'date' => $this->integer(),
            'date_start' => $this->integer(),
            'date_end' => $this->integer(),
            'seo_title' => $this->string(),
            'seo_description' => $this->string(300),
            'create_time' => $this->integer(),
            'update_time' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('mn_informationsystem_item');
    }
}
