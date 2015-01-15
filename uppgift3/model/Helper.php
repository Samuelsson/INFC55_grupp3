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

}


?>