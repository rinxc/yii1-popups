<?php

class m230313_130414_popups extends CDbMigration
{

    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->createTable('popups', array(
        'id_popups' => 'pk',
        'title' => 'varchar(100) NOT NULL',
        'content' => 'text',
        'show' => ' tinyint(1) DEFAULT NULL',
        'animation' => 'varchar(50) NOT NULL',
        'allow_count' => ' tinyint(1) DEFAULT NULL',
        'count' => 'int(11) DEFAULT 0',
        'date_reg' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
        ));
    }

    public function safeDown()
    {
        $this->dropTable('popups');
    }
	
}