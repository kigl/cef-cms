<?php

use yii\db\Migration;

/**
 * Handles the creation for table `tag`.
 */
class m160914_041003_tag extends Migration
{
    public $tableName = '{{%tag}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
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
