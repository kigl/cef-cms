<?php

use yii\db\Migration;

/**
 * Handles the creation for table `mn_tag_relations`.
 */
class m160914_041235_infosystem_item_tag extends Migration
{
    protected $tableName = '{{%infosystem_item_tag}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'item_id' => $this->integer(),
            'tag_id' => $this->integer(),
        ]);

        $this->createIndex('ix-item_tag-item_id', $this->tableName, ['item_id', 'tag_id'], true);
        $this->createIndex('ix-item_tag-tag_id', $this->tableName, 'tag_id');

        $this->addForeignKey('fk-item_tag-item_id', $this->tableName, 'item_id', '{{%infosystem_item}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-item_tag-tag_id', $this->tableName, 'tag_id', '{{%infosystem_tag}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
