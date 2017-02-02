<?php

use yii\db\Migration;

/**
 * Handles the creation for table `mn_forum_post`.
 */
class m161004_054435_forum_post extends Migration
{
    protected $tableName = '{{%forum_post}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable($this->tableName, [
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
        $this->dropTable($this->tableName);
    }
}
