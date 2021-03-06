<?php

/*
 *	functions.php
 *
 *	Here we save all the php functions.
 */

/* ==|== Includes ===============================================================================
	All files that should be included on the homepage, for example Header and Footer.
   ============================================================================================== */

	
	// Header on top of all pages
class ViewFunc
{
	function getHeader() {
		include(PATH . '/view/inc/header.php');
	}

	// Right sidebar on medium and large screens
	function getSidebarRight() {
		include(PATH . '/view/inc/sidebar-right.php');
	}

	// Footer on the bottom of all pages
	function getFooter() {
		include(PATH . '/view/inc/footer.php');
	}

	function getURL($subDir)
	{
		$path = URL_ROOT . $subDir;
		return $path;
	}
}


/* ==|== Misc ===================================================================================
	Misch stuff.
   ============================================================================================== */

   // Redirect function, e.g. used when non logged in user tries to access admin.php
	function redirect_to($url) {
		header("Location: " . $url);
		exit;
	}

?>