<?php

/*	
 *	CONFIG FILE
 *
 *	This is where we store all our configuration files.
 *	Connections to the database for example.
 *
 *	Keep in mind that this file saves all passwords in plain text.
 *	So we should not upload this to GitHub ;)
 *	Preferably we should edit our .htaccess or keep this file outside the root folder.
 */

/* ==|== Database ===============================================================================
	Credentials to our database.
   ============================================================================================== */

	// The server IP to database:
	define('DB_HOST', 'localhost');
	
	//	The name of the database:
	define('DB_NAME', 'infc55');
	
	// The username of the user who has access to the database:
	define('DB_USER', 'infc55');
	
	// The password for the user:
	define('DB_PASS', 'zB3xVdupJCUvvVz5'); // This is just a test password in a test environment - so no luck for you :)


/* ==|== Misc ===================================================================================
	Misc stuff
   ============================================================================================== */

?>