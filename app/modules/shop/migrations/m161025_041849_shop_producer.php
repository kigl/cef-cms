<?php

use yii\db\Migration;

class m161025_041849_shop_producer extends Migration
{
    protected $_tableName = '{{%shop_producer}}';

    public function up()
    {
        $this->createTable($this->_tableName, [
            'id' => $this->primaryKey(),
            'shop_id' => $this->integer(),
            'group_id' => $this->integer(),
            'name' => $this->string(),
            'description' => $this->string(500),
            'content' => $this->text(),
            'image_preview' => $this->string(),
            'image' => $this->string(),
            'sorting' => $this->integer(),
            'meta_title' => $this->string(),
            'meta_description' => $this->string(),
            'meta_keyword' => $this->string(),
        ]);
    }

    public function down()
    {
        $this->dropTable($this->_tableName);
    }
}
