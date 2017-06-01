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
            'sorting' => $this->integer()->defaultValue(0),
            'name' => $this->string()->notNull(),
            'description' => $this->string(500),
            'content' => $this->text(),
            'image_preview' => $this->string(),
            'image' => $this->string(),
            'address' => $this->string(),
            'phone' => $this->string(),
            'fax' => $this->string(),
            'site' => $this->string(),
            'email' => $this->string(),
            'tin' => $this->integer(),
            'kpp' => $this->integer(),
            'psrn' => $this->integer(),
            'okpo' => $this->integer(),
            'okved' => $this->integer(),
            'bik' => $this->integer(),
            'account_number' => $this->integer(),
            'bank_name' => $this->string(),
            'bank_address' => $this->string(),
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
