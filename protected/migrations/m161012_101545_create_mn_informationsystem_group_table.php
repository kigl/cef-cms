<?php

use yii\db\Migration;

/**
 * Handles the creation for table `mn_informationsystem_group`.
 */
class m161012_101545_create_mn_informationsystem_group_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('mn_informationsystem_group', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(),
            'informationsystem_id' => $this->integer(),
            'name' => $this->string(),
            'description' => $this->string(300),
            'content' => $this->text(),
            'image' => $this->string(),
            'sort' => $this->integer(),
            'user_id' => $this->integer(),
            'alias' => $this->string(),
            'meta_title' => $this->string(),
            'meta_description' => $this->string(300),
            'create_time' => $this->timestamp()->defaultValue(null),
            'update_time' => $this->timestamp()->defaultValue(null),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('mn_informationsystem_group');
    }
}
