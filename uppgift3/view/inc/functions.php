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
		include($_SERVER['DOCUMENT_ROOT'] . '/view/inc/header.php');
	}

	// Right sidebar on medium and large screens
	function getSidebarRight() {
		include($_SERVER['DOCUMENT_ROOT'] . '/view/inc/sidebar-right.php');
	}

	// Footer on the bottom of all pages
	function getFooter() {
		include($_SERVER['DOCUMENT_ROOT'] . '/view/inc/footer.php');
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