<?php

use yii\db\Migration;

/**
 * Handles the creation for table `mn_informationsystem_item`.
 */
class m160825_114706_informationsystem_item extends Migration
{
    protected $tableName = '{{%informationsystem_item}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'group_id' => $this->integer()->defaultValue(0),
            'informationsystem_id' => $this->integer(),
            'name' => $this->string()->notNull(),
            'description' => $this->string(300),
            'content' => $this->text(),
            'image' => $this->string(),
            'video' => $this->string(),
            'file' => $this->string(),
            'status' => $this->integer()->defaultValue(1),
            'sort' => $this->integer(),
            'user_id' => $this->integer(),
            'date' => $this->date(),
            'date_start' => $this->date(),
            'date_end' => $this->date(),
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
