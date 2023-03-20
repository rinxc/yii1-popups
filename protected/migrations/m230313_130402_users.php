<?php

class m230313_130402_users extends CDbMigration
{
	
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->createTable('users', array(
            'id_users' => 'pk',
            'login' => 'varchar(100) NOT NULL',
            'password' => 'varchar(100) NOT NULL',
            'active' => ' tinyint(1)',
            'id_users_groups' => 'int(11)',
            'date_reg' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
        ));

        $this->insert('users',array(
            'login' =>'admin',
            'password' => md5('admin'),
            'active' => 1,
            'id_users_groups' => 1
        ));
	}

	public function safeDown()
	{
        $this->dropTable('users');
	}
}