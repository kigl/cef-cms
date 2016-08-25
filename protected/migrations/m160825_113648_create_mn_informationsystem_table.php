<?php

use yii\db\Migration;

/**
 * Handles the creation for table `mn_informationsystem`.
 */
class m160825_113648_create_mn_informationsystem_table extends Migration
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
            'name' => $this->string()->notNull(),
            'description' => $this->string(300),
            'image' => $this->string(),
            'status' => $this->integer(),
            'sort' => $this->integer(),
            'user_id' => $this->integer(),
            'create_time' => $this->integer(),
            'update_time' => $this->integer(),
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
