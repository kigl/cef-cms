<?php

use yii\db\Migration;

/**
 * Handles the creation for table `mn_informationsystem_group`.
 */
class m161012_101545_infosystem_group extends Migration
{
    protected $_tableName = '{{%infosystem_group}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable($this->_tableName, [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(),
            'infosystem_id' => $this->integer(),
            'name' => $this->string(),
            'description' => $this->string(500),
            'content' => $this->text(),
            'image_preview' => $this->string(),
            'image' => $this->string(),
            'sorting' => $this->integer(),
            'status' => $this->integer(),
            'user_id' => $this->integer(),
            'alias' => $this->string(),
            'meta_title' => $this->string(),
            'meta_description' => $this->string(),
            'meta_keyword' => $this->string(),
        ]);

        $this->execute("ALTER TABLE {$this->_tableName} ADD `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `meta_keyword`;");
        $this->execute("ALTER TABLE {$this->_tableName} ADD `update_time` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `create_time`;");

        $this->createIndex('ix-infosystem_group-parent_id', $this->_tableName, 'parent_id');
        $this->createIndex('ix-infosystem_group-infosystem_id', $this->_tableName, 'infosystem_id');
        $this->createIndex('ix-infosystem_group-alias', $this->_tableName, 'alias');
        $this->createIndex('ix-infosystem_group-update_time', $this->_tableName, 'update_time');

        $this->addForeignKey('fk-infosystem_group-infosytem_id', $this->_tableName, 'infosystem_id', '{{%infosystem}}', 'id', 'NO ACTION', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable($this->_tableName);
    }
}
