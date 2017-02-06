<?php

use yii\db\Migration;

/**
 * Handles the creation for table `mn_informationsystem_group`.
 */
class m161012_101545_informationsystem_group extends Migration
{
    protected $tableName = '{{%informationsystem_group}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(),
            'informationsystem_id' => $this->integer(),
            'name' => $this->string(),
            'description' => $this->string(300),
            'content' => $this->text(),
            'image' => $this->string(),
            'user_id' => $this->integer(),
            'alias' => $this->string(),
            'meta_title' => $this->string(),
            'meta_description' => $this->string(300),
        ]);

        $this->execute("ALTER TABLE {$this->tableName} ADD `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `meta_description`;");
        $this->execute("ALTER TABLE {$this->tableName} ADD `update_time` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `create_time`;");
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
