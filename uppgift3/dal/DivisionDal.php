<?php

	class DivisionDal
	{
		private $dbh;

		function __construct($dbh)	{
			$this->dbh = $dbh;
		}

		function getDivision($divisionId) {
			
			$query = $this->dbh->query("SELECT * FROM Divisions WHERE divisionId = '$divisionId'");
			$query->setFetchMode(\PDO::FETCH_CLASS, 'Division');
			return $query->fetch();
		}

		function getDivisionsForCup($cupId) {
			$query = $this->dbh->query("SELECT * FROM Divisions WHERE cupId = '$cupId'");
			$query->setFetchMode(\PDO::FETCH_CLASS, 'Division');
			return $query->fetchAll();
		}

		function isScheduleGenerated($divisionId) {
			$sql = "SELECT scheduleGenerated FROM Divisions WHERE divisionId = $divisionId";
			$query = $this->dbh->query($sql);

			$result = $query->fetch();

			$bool = $result['scheduleGenerated'];
			return $bool;
		}

		function isStageDone($divisionId, $stage) {
			$sql = "SELECT $stage FROM Divisions WHERE divisionId = $divisionId";
			$query = $this->dbh->query($sql);

			$result = $query->fetch();

			$bool = $result['$stage'];
			return $bool;
		}
	}	

?>