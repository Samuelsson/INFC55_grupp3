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

	function checkLogin($email, $pwd) {
		$result = $this->helperDal->getLogin($email, $pwd);
		if($result['password'] == $pwd) //SKALL MD5AS och SALTAS!!!
		{
			
		}
		else
		{
			
		}
	}
}

?>