<?php

use yii\db\Migration;

/**
 * Handles the creation for table `tag`.
 */
class m160914_041003_create_mn_informationsystem_item_tag_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('mn_informationsystem_item_tag', [
            'id' => $this->primaryKey(),
            'informationsystem_id' => $this->string(50),
            'name' => $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('mn_informationsystem_item_tag');
    }
}
