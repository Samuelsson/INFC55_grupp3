<?php

	class CupDal
	{
		private $dbh;

		function __construct($dbh)	{
			$this->dbh = $dbh;
		}

		function getCup($cupId) {
			
			$query = $this->dbh->query("SELECT * FROM Cups WHERE cupId = '$cupId'");
			$query->setFetchMode(\PDO::FETCH_CLASS, 'Cup');

			return $query->fetch();
		}

		function getAllCups() {
			$query = $this->dbh->query("SELECT * FROM Cups");
			$query->setFetchMode(\PDO::FETCH_CLASS, 'Cup');

			return $query->fetchAll();
		}
	}

?>