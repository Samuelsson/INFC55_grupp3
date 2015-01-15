<?php
require (PATH . '/dal/HelperDal.php');
/**
* 
*/
class Helper {

	private $controller;
	private $helperDal;


	function __construct($cont) {
		$this->controller = $cont;
		$this->helperDal = new HelperDal($cont->dbh); //DAL för helpern. Skickar in kopplingen till databasen.
	}

	//This function runs on every page and checks if the user is logged in (by cookies).
	function checkLoggedInCookie() {
		if(isset($_COOKIE['login_name']) && isset($_COOKIE['login_pwd'])) {
			$this->checkLogin($_COOKIE['login_name'], $_COOKIE['login_pwd']);
		}
	}

	//Kontrollerar om en email/lösen-kombination finns i databasen.
	function checkLogin($email, $pwd) {
		$result = $this->helperDal->getLogin($email, $pwd);
		if($result['password'] == $pwd) {  	//SKALL MD5AS och SALTAS!!!
			
			setcookie("login_name", $email, time() + (86400 * 7), "/"); //Sätter cookies eller uppdaterar dem om de finns. 
			setcookie("login_pwd", $pwd, time() + (86400 * 7), "/");
			global $LOGGED_IN; //Hämtar en global variabel
			global $CURRENT_USER;
			$LOGGED_IN = true; //Sätter den globala variabeln
			$CURRENT_USER = $this->controller->getUser($result['userId']);
			return true;
		}
		else
			return false;
	}


	//Function for logging in. 
	function login($email, $pwd) {
		if($this->checkLogin($email, $pwd))
			header('location: logged_in.php'); //If succesfull, send user to an other page.
	}

	//Removes the login cookies
	function logout() {
		setcookie("login_name", "", time() -3600, "/");
		setcookie("login_pwd", "", time() -3600, "/");
	}

	//Sets the minimum access level of a page.
	function setAccessLevel($lvl) {
		global $CURRENT_USER;
		if($CURRENT_USER->accessLevel >= $lvl)
			;
		else
			die("Du har inte till&aring;telse att anv&auml;nda denna sida.");
	}


	/* Returns true or false depending on if the user level is present in $levels
	 * Should be used in an if statement
	 * @param $levels A stirng in the format "1,2,3,4"
	 */
	function setSpecificAccess($levels) {
		$levelArr = explode(",", $levels); //Creates an array of the levels.
		global $CURRENT_USER;
		return in_array($CURRENT_USER->accessLevel, $levelArr);
	}

	/*
	* Returns a properly formatted link if the user is of a specific level.
	* @param $levels A stirng in the format "1,2,3,4"
	* @param $url An url from the root folder
	* @param $text The text that is displayed in the menu
	*/
	function accessLink($levels, $url, $text) {
		$levelArr = explode(",", $levels);
		global $CURRENT_USER;
		if(in_array($CURRENT_USER->accessLevel, $levelArr)) {
			return "<a href=\"" . $this->controller->getURL($url) ."\">$text</a>";
		}
	}



}


?>