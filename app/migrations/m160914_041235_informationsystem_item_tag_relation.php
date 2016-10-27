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
            'item_id' => $this->integer(),
            'tag_id' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
