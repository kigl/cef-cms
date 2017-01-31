<?php

use yii\db\Migration;

/**
 * Handles the creation for table `tag`.
 */
class m160914_041003_informationsystem_item_tag extends Migration
{
    public $tableName = '{{%informationsystem_item_tag}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'informationsystem_id' => $this->integer(),
            'name' => $this->string(),
        ]);

        $this->createIndex('ix-informationsystem_item_tag-informationsystem_id', $this->tableName, 'informationsystem_id');
        $this->createIndex('ix-item_tag-tag_id', $this->tableName, 'tag_id');

        $this->addForeignKey('fk-informationsystem_item_tag-informationsystem_id', $this->tableName, 'informationsystem_id', '{{%informationsystem}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
