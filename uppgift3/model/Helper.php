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
			$LOGGED_IN = true; //Sätter den globala variabeln
			return true;
		}
		else
			return false;
	}

	
	function login($email, $pwd) {

	}

	//Removes the login cookies
	function logout() {
		setcookie("login_name", "", time() -3600, "/");
		setcookie("login_pwd", "", time() -3600, "/");
	}

}


?>