<?php

	class UserDal
	{
		private $dbh;

		function __construct($dbh)	{
			$this->dbh = $dbh;
		}

		function getUser($userId) {

			$query = $this->dbh->query("SELECT * FROM Users WHERE userId = '$userId'");
			$query->setFetchMode(\PDO::FETCH_CLASS, 'User');
			return $query->fetch();
		}
	}

?>