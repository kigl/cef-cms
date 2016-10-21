<?php

use yii\db\Migration;

/**
 * Handles the creation for table `mn_forum_post`.
 */
class m161004_054435_create_mn_forum_post_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('mn_forum_post', [
            'id' => $this->primaryKey(),
            'topic_id' => $this->integer(),
            'content' => $this->text(),
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
        $this->dropTable('mn_forum_post');
    }
}
