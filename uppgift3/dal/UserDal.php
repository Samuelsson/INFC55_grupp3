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

		
		function getAllUsers() {
			$sqlQuery = "SELECT * FROM Users";
			return $this->dbh->query($sqlQuery);
		}

		function getCupMasters() {
			$sql = "SELECT userId, email FROM Users WHERE accessLevel <= '2'";
			$query = $this->dbh->query($sql);
			$query->setFetchMode(\PDO::FETCH_CLASS, 'User');
			return $query->fetchAll();
		}
	}

?>