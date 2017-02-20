<?php

use yii\db\Migration;

/**
 * Handles the creation for table `mn_tag_relations`.
 */
class m160914_041235_infosystem_element_tag extends Migration
{
    protected $tableName = '{{%infosystem_element_tag}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'element_id' => $this->integer(),
            'tag_id' => $this->integer(),
        ]);

        $this->createIndex('ix-element_tag-element_id', $this->tableName, ['element_id', 'tag_id'], true);
        $this->createIndex('ix-element_tag-tag_id', $this->tableName, 'tag_id');

        $this->addForeignKey('fk-element_tag-element_id', $this->tableName, 'element_id', '{{%infosystem_element}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-element_tag-tag_id', $this->tableName, 'tag_id', '{{%infosystem_tag}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
