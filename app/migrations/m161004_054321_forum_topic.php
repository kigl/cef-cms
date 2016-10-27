<?php

use yii\db\Migration;

/**
 * Handles the creation for table `mn_forum_topic`.
 */
class m161004_054321_forum_topic extends Migration
{
    protected $tableName = '{{%forum_topic}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable($this->tableName, [
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
        $this->dropTable($this->tableName);
    }
}
