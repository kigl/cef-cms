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
            'infosystem_id' => $this->string(100),
            'name' => $this->string(),
            'description' => $this->string(300),
            'content' => $this->text(),
            'image_description' => $this->string(),
            'image_content' => $this->string(),
            'sorting' => $this->integer()->defaultValue(500),
            'status' => $this->integer(),
            'site_id' => $this->integer(),
            'user_id' => $this->integer(),
            'alias' => $this->string(),
            'meta_title' => $this->string(),
            'meta_description' => $this->string(300),
        ]);

        $this->execute("ALTER TABLE {$this->_tableName} ADD `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `meta_description`;");
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
