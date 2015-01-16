<?php

class m150116_012507_create_user_table extends CDbMigration
{
	public function up()
	{
		$this->db->createCommand()->createTable('users', [
				'id' => 'pk',
				'username' => 'string(128) NOT NULL',
				'password' => 'string(128) NOT NULL',
				'auth_key'  => 'string(128) NOT NULL',
				])->execute();
		
		// usernameをuniqueに
		$this->createIndex('username', 'users', 'username', true);
	}

	public function down()
	{
		echo "m150116_012507_create_user_table does not support migration down.\n";
//		$this->db->createCommand()->dropTable('users')->execute();
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}