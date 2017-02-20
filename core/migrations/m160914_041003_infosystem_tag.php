<?php

use yii\db\Migration;

/**
 * Handles the creation for table `tag`.
 */
class m160914_041003_infosystem_tag extends Migration
{
    public $tableName = '{{%infosystem_tag}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'infosystem_id' => $this->integer(),
            'name' => $this->string(),
        ]);

        $this->createIndex('ix-infosystem_tag-infosystem_id', $this->tableName, 'infosystem_id');

        $this->addForeignKey('fk-infosystem_tag-infosystem_id', $this->tableName, 'infosystem_id', '{{%infosystem}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
