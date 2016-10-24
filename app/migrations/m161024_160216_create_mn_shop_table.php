<?php

use yii\db\Migration;

/**
 * Handles the creation for table `mn_shop`.
 */
class m161024_160216_create_mn_shop_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('mn_shop', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'description' => $this->string(),
            'content' => $this->text(),
            'create_time' => $this->timestamp(),
            'update_time' => $this->timestamp(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('mn_shop');
    }
}
