<?php

	/**
	* 
	*/
	class HelperDal {
		
		private $dbh;

		function __construct($dbh)	{
			$this->dbh = $dbh;
		}

		function getLogin($email, $pwd) {

			//Get the correct user row.
			$sqlQuery = "SELECT * FROM Users WHERE email = '$email'";
			$query = $this->dbh->query($sqlQuery);
			return $query->fetch();
		}
	}

?>