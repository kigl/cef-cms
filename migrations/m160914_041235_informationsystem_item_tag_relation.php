<?php

use yii\db\Migration;

/**
 * Handles the creation for table `mn_tag_relations`.
 */
class m160914_041235_informationsystem_item_tag_relation extends Migration
{
    protected $tableName = '{{%informationsystem_item_tag_relation}}';

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

        $this->createIndex('ix-item_tag-item_id', $this->tableName, 'item_id');
        $this->createIndex('ix-item_tag-tag_id', $this->tableName, 'tag_id');

        $this->addForeignKey('fk-item_tag-item_id', $this->tableName, 'item_id', '{{%informationsystem_item}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-item_tag-tag_id', $this->tableName, 'tag_id', '{{%informationsystem_item_tag}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
