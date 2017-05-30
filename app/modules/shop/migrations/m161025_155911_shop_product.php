<?php

use yii\db\Migration;

class m161025_155911_shop_product extends Migration
{
    protected $_tableName = '{{%shop_product}}';

    public function up()
    {
        $this->createTable($this->_tableName, [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(),
            'group_id' => $this->integer(),
            'shop_id' => $this->integer(),
            'producer_id' => $this->integer(),
            'measure_id' => $this->integer(),
            'vendor_code' => $this->string(),
            'name' => $this->string()->notNull(),
            'description' => $this->string(500),
            'content' => $this->text(),
            'weight' => $this->decimal(8, 2),
            'discount' => $this->decimal(8, 2),
            'length' => $this->decimal(12, 2),
            'width' => $this->decimal(12, 2),
            'height' => $this->decimal(12,2),
            'active' => $this->integer(),
            'sorting' => $this->integer(),
            'user_id' => $this->integer(),
            'alias' => $this->string(),
            'meta_title' => $this->string(),
            'meta_description' => $this->string(),
            'meta_keyword' => $this->string(),
        ]);

        $this->execute("ALTER TABLE {$this->_tableName} ADD `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `meta_keyword`;");
        $this->execute("ALTER TABLE {$this->_tableName} ADD `update_time` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `create_time`;");
    }

    public function down()
    {
        $this->dropTable($this->_tableName);
    }
}
