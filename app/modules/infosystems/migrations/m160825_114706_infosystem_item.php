<?php

use yii\db\Migration;

/**
 * Handles the creation for table `mn_informationsystem_item`.
 */
class m160825_114706_infosystem_item extends Migration
{
    protected $_tableName = '{{%infosystem_item}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable($this->_tableName, [
            'id' => $this->primaryKey(),
            'group_id' => $this->integer(),
            'infosystem_id' => $this->integer(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'content' => $this->text(),
            'image_preview' => $this->string(),
            'image' => $this->string(),
            //'video' => $this->string(),
            'file' => $this->string(),
            'status' => $this->integer(),
            'sorting' => $this->integer(),
            'counter' => $this->integer(),
            'user_id' => $this->integer(),
            'date' => $this->dateTime(),
            'date_start' => $this->dateTime(),
            'date_end' => $this->dateTime(),
            'alias' => $this->string(),
            'meta_title' => $this->string(),
            'meta_description' => $this->string(),
            'meta_keyword' => $this->string(),
        ]);

        $this->execute("ALTER TABLE {$this->_tableName} ADD `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `meta_keyword`;");
        $this->execute("ALTER TABLE {$this->_tableName} ADD `update_time` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `create_time`;");

        $this->createIndex('ix-infosystem_item-group_id', $this->_tableName, 'group_id');
        $this->createIndex('ix-infosystem_item-infosystem_id', $this->_tableName, 'infosystem_id');
        $this->createIndex('ix-infosystem_item-alias', $this->_tableName, 'alias');

        $this->addForeignKey('fk-infosystem-infossytem_id', $this->_tableName, 'infosystem_id', '{{%infosystem}}', 'id', 'NO ACTION', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable($this->_tableName);
    }
}
