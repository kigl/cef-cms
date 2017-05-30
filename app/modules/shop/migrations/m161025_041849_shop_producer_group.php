<?php

use yii\db\Migration;

class m161025_041849_shop_producer_group extends Migration
{
    protected $_tableName = '{{%shop_producer_group}}';

    public function up()
    {
        $this->createTable($this->_tableName, [
            'id' => $this->primaryKey(),
            'shop_id' => $this->integer(),
            'name' => $this->string(),
            'image_preview' => $this->string(),
            'image' => $this->string(),
            'description' => $this->string(500),
            'sorting' => $this->integer(),
        ]);
    }

    public function down()
    {
        $this->dropTable($this->_tableName);
    }
}
