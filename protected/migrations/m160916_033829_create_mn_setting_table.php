<?php

use yii\db\Migration;

/**
 * Handles the creation for table `mn_setting`.
 */
class m160916_033829_create_mn_setting_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('mn_setting', [
            'id' => $this->primaryKey(),
            'module_id' => $this->string(50),
            'name' => $this->string(),
            'label' => $this->string(),
            'value' =>$this->string(),
            'type_id' => $this->integer(),
            'user_id' => $this->integer(),
            'create_time' => $this->integer(),
            'update_time' => $this->integer(),
        ]);
        
        $this->batchInsert('mn_setting',
        	 ['module_id', 'name', 'label', 'value', 'type_id'],
        	 [
        	 	['main', 'site_name', 'Название сайта', '', '0'],
        	 	['main', 'site_description', 'Описание сайта', '', '2']
        	 ]
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('mn_setting');
    }
}
