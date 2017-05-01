<?php

use yii\db\Migration;

/**
 * Handles the creation for table `mn_informationsystem_item`.
 */
class m160825_114706_infosystem_item extends Migration
{
    protected $tableName = '{{%infosystem_item}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'group_id' => $this->integer(),
            'infosystem_id' => $this->string(100),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'content' => $this->text(),
            'image_1' => $this->string(),
            'image_2' => $this->string(),
            //'video' => $this->string(),
            'file' => $this->string(),
            'status' => $this->integer()->defaultValue(),
            'sorting' => $this->integer()->defaultValue(),
            'counter' => $this->integer()->defaultValue(0),
            'user_id' => $this->integer(),
            'date' => $this->dateTime(),
            'date_start' => $this->dateTime(),
            'date_end' => $this->dateTime(),
            'alias' => $this->string(),
            'meta_title' => $this->string(),
            'meta_description' => $this->string(),
        ]);

        $this->execute("ALTER TABLE {$this->tableName} ADD `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `meta_description`;");
        $this->execute("ALTER TABLE {$this->tableName} ADD `update_time` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `create_time`;");

        $this->createIndex('ix-infosystem_item-group_id', $this->tableName, 'group_id');
        $this->createIndex('ix-infosystem_item-infosystem_id', $this->tableName, 'infosystem_id');
        $this->createIndex('ix-infosystem_item-alias', $this->tableName, 'alias');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
