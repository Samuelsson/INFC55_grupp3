<?php

/*	
 *	CONFIG FILE
 *
 *	##################################################
 *	SAVE THIS FILE AS config.php AND ENTER CREDENTIALS
 *	DO NOT RENAME IT - IT WILL BE DELETED FROM GITHUB!
 *	##################################################
 *
 *	This is where we store all our configurations.
 *	Connections to the database for example.
 *
 *	Keep in mind that this file saves all passwords in plain text.
 *	Preferably edit the .htaccess or even keep this file outside the root folder.
 */

/* ==|== Database ===============================================================================
	Credentials to the database.
   ============================================================================================== */

	// The server IP to database:
	define('DB_HOST', 'localhost');

	//	The port of the database (default is 3306):
	define('DB_PORT', '3306');
	
	//	The name of the database:
	define('DB_NAME', '');
	
	// The username of the user who has access to the database:
	define('DB_USER', '');
	
	// The password for the user:
	define('DB_PASS', '');


/* ==|== Misc ===================================================================================
	Misc stuff
   ============================================================================================== */
	
	// Path from root to index.php. I.E. '/INFC55_grupp3/uppgift3/'
	$path = '/path/to/uppgift3/';

	// No need to change anything here on PATH and URL_ROOT constants
	define('PATH', $_SERVER['DOCUMENT_ROOT'] . $path);
	define('URL_ROOT', $path);

?>