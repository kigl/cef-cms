<?php

use yii\db\Migration;

/**
 * Handles the creation for table `mn_tag_relations`.
 */
class m160914_041235_create_mn_informationsystem_item_tag_relation_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('mn_informationsystem_item_tag_relation', [
            'item_id' => $this->integer(),
            'tag_id' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('mn_informationsystem_item_tag_relation');
    }
}
