<?php

	class DivisionDal
	{
		private $dbh;

		function __construct($dbh)	{
			$this->dbh = $dbh;
		}

		function getDivision($divisionId) {
			
			$query = $this->dbh->query("SELECT * FROM Division WHERE divisionId = '$divisionId'");
			$query->setFetchMode(\PDO::FETCH_CLASS, 'Division');

			return $query->fetch();
		}

		function getDivisionsForCup($cupId) {
			$query = $this->dbh->query("SELECT * FROM Divisions WHERE cupId = '$cupId'");
			$query->setFetchMode(\PDO::FETCH_CLASS, 'Division');

			return $query->fetchAll();
		}
	}

?>