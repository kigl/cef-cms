<?php

use yii\db\Migration;

/**
 * Handles the creation for table `mn_forum_topic`.
 */
class m161004_054321_create_mn_forum_topic_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('mn_forum_topic', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer()->defaultValue(0),
            'name' => $this->string(),
            'user_id' => $this->integer(),
            'counter' => $this->integer()->defaultValue(0),
            'create_time' => $this->integer(),
            'update_time' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('mn_forum_topic');
    }
}
