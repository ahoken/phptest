<?php

// This is the database connection configuration.
return array(
	//SQLite
	//	'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
	
	// uncomment the following lines to use a MySQL database
	'connectionString' => 'mysql:dbname=testdrive;host=localhost',
	'emulatePrepare' => true,
	'username' => 'test',
	'password' => 'test',
	'charset' => 'utf8',
);